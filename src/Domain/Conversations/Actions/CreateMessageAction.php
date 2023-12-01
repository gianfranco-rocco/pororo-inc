<?php

declare(strict_types=1);

namespace Domain\Conversations\Actions;

use App\Integrations\Puppeteer\DataTransferObjects\PuppeteerMessage;
use App\Integrations\Puppeteer\Requests\CreatePuppeteerThreadChatRequest;
use Domain\Conversations\Models\Conversation;
use Domain\Conversations\Models\Message;
use Illuminate\Support\Facades\DB;

class CreateMessageAction
{
    private const USER = 'user';

    private const ASSISTANT = 'assistant';

    public function execute(string $content, Conversation $conversation): Message
    {
        /** @var PuppeteerMessage $puppeteerMessage */
        $puppeteerMessage = (new CreatePuppeteerThreadChatRequest($conversation->thread_id, $content))->send()->dto();

        return DB::transaction(
            function () use ($conversation, $content, $puppeteerMessage) {
                Message::create([
                    'conversation_id' => $conversation->id,
                    'role' => self::USER,
                    'content' => $content,
                ]);

                return Message::create([
                    'conversation_id' => $conversation->id,
                    'role' => self::ASSISTANT,
                    'content' => json_encode([
                        'content' => $puppeteerMessage->content,
                    ]),
                ]);
            }
        );
    }
}
