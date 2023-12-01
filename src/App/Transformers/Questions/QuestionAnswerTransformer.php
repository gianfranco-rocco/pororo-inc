<?php

declare(strict_types=1);

namespace App\Transformers\Questions;

use Domain\Questions\Models\QuestionAnswer;
use Flugg\Responder\Transformers\Transformer;

class QuestionAnswerTransformer extends Transformer
{
    public function transform(QuestionAnswer $questionAnswer): array
    {
        return [
            'answer' => $questionAnswer->answer
        ];
    }
}
