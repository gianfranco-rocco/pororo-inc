<?php

declare(strict_types=1);

namespace Domain\Questions\Actions;

use Domain\Questions\Models\Question;
use Illuminate\Support\Collection;

class GetDailyQuestionsAction
{
    /**
     * @return Collection<int, Question>
     */
    public function execute(int $amount = 3): Collection
    {
        /** @var Collection<int, Question> $questions */
        $questions = Question::query()
            ->inRandomOrder()
            ->take($amount)
            ->get();

        return $questions;
    }
}
