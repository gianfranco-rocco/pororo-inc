<?php

declare(strict_types=1);

namespace App\Transformers\Conversations;

use Domain\Conversations\Models\Conversation;
use Flugg\Responder\Transformers\Transformer;

class ConversationTransformer extends Transformer
{
    public $relations = [
        'messages' => MessageTransformer::class
    ];

    public function transform(Conversation $conversation): array
    {
        return [
            'id' => $conversation->id,
            'finished' => $conversation->isClosed(),
            'verdictType' => null
        ];
    }
}
