<?php

declare(strict_types=1);

namespace App\Transformers\Conversations;

use Domain\Conversations\Models\Conversation;
use Flugg\Responder\Transformers\Transformer;

class ConversationTransformer extends Transformer
{
    public function transform(Conversation $conversation): array
    {
        return [
            'finished' => false,
            'verdictType' => null
        ];
    }
}
