<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Users;

use App\Transformers\Users\UserTransformer;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;

class GetUserController
{
    public function __invoke(User $user): JsonResponse
    {
        return responder()
            ->success($user, UserTransformer::class)
            ->respond();
    }
}
