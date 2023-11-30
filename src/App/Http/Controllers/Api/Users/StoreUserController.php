<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Users;

use App\Http\Requests\Api\Users\StoreUserRequest;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;

class StoreUserController
{
    public function __invoke(StoreUserRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::create((array) $request->validated());

        return responder()
            ->success($user)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
