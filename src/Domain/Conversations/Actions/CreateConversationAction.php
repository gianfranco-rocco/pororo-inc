<?php

declare(strict_types=1);

namespace Domain\Conversations\Actions;

use App\Integrations\Puppeteer\DataTransferObjects\PuppeteerThread;
use App\Integrations\Puppeteer\Requests\CreatePuppeteerThreadRequest;
use Domain\Conversations\Models\Conversation;
use Domain\Conversations\Models\Message;
use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateConversationAction
{
    public const ASSISTANT_FIRST_MESSAGE = [
        'content' => "Hi :name, how can I help you today?",
    ];

    public function execute(Request $request, User $patient): Message
    {
        return DB::transaction(function () use ($request, $patient) {
            /** @var PuppeteerThread $thread */
            $thread = (new CreatePuppeteerThreadRequest())->send()->dto();

            /** @var Conversation $conversation */
            $conversation = $patient->conversations()->create([
                'ip' => $request->ip(),
                'thread_id' => $thread->id,
            ]);

            $content = Str::replace(':name', $patient->name, self::ASSISTANT_FIRST_MESSAGE);

            /** @var Message $message */
            $message = $conversation->messages()->create([
                'role' => 'assistant',
                'content' => json_encode($content)
            ]);

            return $message;
        });
    }
}
