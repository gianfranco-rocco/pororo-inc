<?php

declare(strict_types=1);

namespace Domain\Questions\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Collection;

class AnswerQuestionAction
{
    /**
     * @param Collection<int, array{questionId: int, ids: int[]}> $answers
     */
    public function execute(User $patient, Collection $answers): void
    {
        $answers->each(function (array $answers) use ($patient) {
            foreach ($answers['ids'] as $answerId) {
                $patient->answers()->create([
                    'question_answer_id' => $answerId
                ]);
            }
        });
    }
}
