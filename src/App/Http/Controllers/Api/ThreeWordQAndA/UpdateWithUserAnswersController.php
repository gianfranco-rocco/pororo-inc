<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\ThreeWordQAndA;

use App\Http\Requests\Api\ThreeWordQAndA\UpdateThreeWordQAndARequest;
use App\Transformers\ThreeWordQAndA\ThreeWordQAndATransformer;
use Domain\ThreeWordQAndA\Models\ThreeWordQAndA;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class UpdateWithUserAnswersController
{
    public function __invoke(
        UpdateThreeWordQAndARequest $request,
        ThreeWordQAndA $game,
    ): JsonResponse {
        $attributes = $request->only([
            'a_word_1', 'a_word_2', 'a_word_3'
        ]);

        $attributes['answered_at'] = Carbon::now();

        $game->update($attributes);

        return responder()
            ->success($game, ThreeWordQAndATransformer::class)
            ->respond(JsonResponse::HTTP_OK);
    }
}
