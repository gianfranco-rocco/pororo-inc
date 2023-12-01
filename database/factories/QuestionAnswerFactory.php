<?php

declare(strict_types=1);

namespace Database\Factories;

use Domain\Questions\Models\QuestionAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuestionAnswer>
 */
class QuestionAnswerFactory extends Factory
{
    protected $model = QuestionAnswer::class;

    public function definition(): array
    {
        return [
            'question_id' => QuestionFactory::new(),
            'answer' => fake()->word(),
        ];
    }
}
