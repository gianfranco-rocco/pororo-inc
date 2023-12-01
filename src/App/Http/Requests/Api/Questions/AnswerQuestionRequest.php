<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Questions;

use Illuminate\Foundation\Http\FormRequest;

class AnswerQuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'answers' => ['required', 'array'],
            'answers.*.ids' => ['required', 'exists:question_answers,id'],
            'answers.*.questionId' => ['required', 'exists:questions,id']
        ];
    }
}
