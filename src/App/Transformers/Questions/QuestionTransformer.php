<?php

declare(strict_types=1);

namespace App\Transformers\Questions;

use Domain\Questions\Models\Question;
use Flugg\Responder\Transformers\Transformer;

class QuestionTransformer extends Transformer
{
    protected $relations = [
        'answers' => QuestionAnswerTransformer::class
    ];

    public function transform(Question $question): array
    {
        return [
            'id' => (int) $question->id,
            'question' => $question->question
        ];
    }
}
