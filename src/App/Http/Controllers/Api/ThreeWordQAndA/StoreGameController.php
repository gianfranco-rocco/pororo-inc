<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\ThreeWordQAndA;

use App\Transformers\ThreeWordQAndA\ThreeWordQAndATransformer;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Domain\ThreeWordQAndA\Actions\InitializeGameAction;

class StoreGameController
{
    public function __invoke(User $user)
    {
        $game = (new InitializeGameAction())->execute($user->id);

        return responder()
            ->success($game, ThreeWordQAndATransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
