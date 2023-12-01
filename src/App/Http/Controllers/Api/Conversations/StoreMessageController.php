<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Conversations;

use App\Http\Requests\Api\Conversations\CreateMessageFormRequest;
use App\Transformers\Conversations\MessageTransformer;
use Domain\Conversations\Actions\CreateMessageAction;
use Domain\Conversations\Models\Conversation;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;

class StoreMessageController
{
    public function __invoke(
        CreateMessageFormRequest $request,
        User $user,
        Conversation $conversation,
        CreateMessageAction $createMessageAction,
    ): JsonResponse {
        $message = $createMessageAction
            ->execute(
                $request->string('content')->toString(),
                $conversation
            );

        return responder()
            ->success($message, MessageTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
