<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Questions;

use Database\Factories\QuestionAnswerFactory;
use Database\Factories\QuestionFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetDailyQuestionsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_responds_with_random_questions(): void
    {
        $question1 = QuestionFactory::new()->createOne();

        QuestionAnswerFactory::new()
            ->for($question1)
            ->count(6)
            ->create();

        $question2 = QuestionFactory::new()->createOne();

        QuestionAnswerFactory::new()
            ->for($question2)
            ->count(3)
            ->create();

        $question3 = QuestionFactory::new()->createOne();

        QuestionAnswerFactory::new()
            ->for($question3)
            ->count(5)
            ->create();

        $this
            ->getJson(route('api.questions.daily', [
                'with' => 'answers'
            ]))
            ->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
