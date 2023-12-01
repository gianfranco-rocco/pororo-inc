<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Conversations;

use App\Transformers\Conversations\MessageTransformer;
use Domain\Conversations\Actions\CreateConversationAction;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreConversationController
{
    public function __invoke(
        Request $request,
        User $user,
        CreateConversationAction $createConversationAction,
    ): JsonResponse {
        /** @var string $ipAddress */
        $ipAddress = $request->ip();

        $message = $createConversationAction->execute($ipAddress, $user);

        return responder()
            ->success($message, MessageTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
