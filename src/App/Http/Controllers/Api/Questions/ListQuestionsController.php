<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Questions;

use App\Transformers\Questions\QuestionTransformer;
use Domain\Questions\Models\Question;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;

class ListQuestionsController
{
    public function __invoke(User $user): JsonResponse
    {
        return responder()
            ->success(Question::all(), QuestionTransformer::class)
            ->respond();
    }
}
