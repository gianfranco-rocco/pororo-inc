<?php

declare(strict_types=1);

namespace App\Transformers\Conversations;

use Domain\Conversations\Models\Message;
use Flugg\Responder\Transformers\Transformer;
use Illuminate\Support\Facades\Crypt;

class MessageTransformer extends Transformer
{
    protected $load = [
        'conversation' => ConversationTransformer::class
    ];

    public function transform(Message $message): array
    {
        return [
            'id' => $message->id,
            'role' => $message->role,
            'content' => $message->content(),
            'token' => Crypt::encrypt(['conversation_id' => $message->conversation_id]),
            'sent_at' => $message->created_at,
        ];
    }
}
