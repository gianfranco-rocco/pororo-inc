<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Questions;

use App\Http\Requests\Api\Questions\AnswerQuestionRequest;
use Domain\Questions\Actions\AnswerQuestionAction;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;

class AnswerQuestionController
{
    public function __invoke(
        AnswerQuestionRequest $request,
        User $patient,
        AnswerQuestionAction $answerQuestionAction,
    ): JsonResponse {
        $answerQuestionAction->execute($patient, $request->collect('answers'));

        return responder()
            ->success()
            ->respond();
    }
}
