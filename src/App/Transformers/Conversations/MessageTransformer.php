<?php

declare(strict_types=1);

namespace App\Transformers\Conversations;

use Domain\Conversations\Models\Message;
use Flugg\Responder\Transformers\Transformer;

class MessageTransformer extends Transformer
{
    protected $load = [
        'conversation' => ConversationTransformer::class
    ];

    public function transform(Message $message): array
    {
        $messageContent = $message->content;

        $jsonContent = json_decode($messageContent, true);

        if (gettype($jsonContent) === 'array') {
            $messageContent = array_key_exists('content', $jsonContent) ? $jsonContent['content'] : '';
        }

        return [
            'id' => $message->id,
            'role' => $message->role,
            'content' => $messageContent,
            'sent_at' => $message->created_at,
        ];
    }
}
