<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Conversations;

use App\Transformers\Conversations\MessageTransformer;
use Domain\Conversations\Models\Conversation;
use Illuminate\Http\JsonResponse;

class GetMessagesController
{
    public function __invoke(Conversation $conversation): JsonResponse
    {
        return responder()
            ->success($conversation->messages, MessageTransformer::class)
            ->respond();
    }
}
