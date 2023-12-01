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

    public function execute(Request $request, User $user): Message
    {
        return DB::transaction(function () use ($request, $user) {
            /** @var PuppeteerThread $thread */
            $thread = (new CreatePuppeteerThreadRequest())->send()->dto();

            $conversation = Conversation::create(['ip' => $request->ip(), 'thread_id' => $thread->id]);

            $content = Str::replace(':name', $user->name, self::ASSISTANT_FIRST_MESSAGE);

            return Message::create([
                'conversation_id' => $conversation->id,
                'role' => 'assistant',
                'content' => json_encode($content)
            ]);
        });
    }
}
