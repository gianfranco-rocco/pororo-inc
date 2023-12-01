<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Conversations;

use App\Transformers\Conversations\MessageTransformer;
use Domain\Conversations\Actions\CreateConversationAction;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StoreConversationController
{
    public function __invoke(
        Request $request,
        User $user,
        CreateConversationAction $createConversationAction,
    ): JsonResponse {
        $firstMessage = $createConversationAction->execute($request, $user);

        $conversationToken = Crypt::encrypt(['conversation_id' => $firstMessage->conversation_id]);

        $response = [...(new MessageTransformer())->transform($firstMessage), 'token' => $conversationToken];

        return responder()
            ->success($response)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
