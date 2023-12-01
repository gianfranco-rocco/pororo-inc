<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Questions;

use App\Transformers\Questions\QuestionTransformer;
use Domain\Questions\Actions\GetDailyQuestionsAction;
use Illuminate\Http\JsonResponse;

class GetDailyQuestionsController
{
    public function __invoke(GetDailyQuestionsAction $getDailyQuestionsAction): JsonResponse
    {
        return responder()
            ->success($getDailyQuestionsAction->execute(), QuestionTransformer::class)
            ->respond();
    }
}
