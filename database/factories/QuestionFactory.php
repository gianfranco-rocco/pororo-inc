<?php

declare(strict_types=1);

namespace Database\Factories;

use Domain\Questions\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'question' => fake()->word(),
        ];
    }
}
