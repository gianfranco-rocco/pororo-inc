<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Users;

use App\Transformers\Users\UserTransformer;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;

class ListUserController
{
    public function __invoke(): JsonResponse
    {
        return responder()
            ->success(User::paginate(), UserTransformer::class)
            ->respond();
    }
}
