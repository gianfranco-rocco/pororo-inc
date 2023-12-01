<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Questions;

use Database\Factories\QuestionAnswerFactory;
use Database\Factories\QuestionFactory;
use Database\Factories\UserFactory;
use Domain\Questions\Models\QuestionAnswer;
use Domain\Users\Models\UserAnswer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnswerQuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_answer_questions(): void
    {
        $question = QuestionFactory::new()->createOne();

        /** @var Collection<int, QuestionAnswer> $answers */
        $answers = QuestionAnswerFactory::new()
            ->for($question)
            ->count(6)
            ->create();

        $patient = UserFactory::new()
            ->patient()
            ->createOne();

        /** @var QuestionAnswer $questionAnswer */
        $questionAnswer = $answers->first();

        $this
            ->postJson(route('api.questions.answer', [
                'patient' => $patient,
            ]), [
                'answers' => [
                    [
                        'questionId' => $question->id,
                        'ids' => [$questionAnswer->id]
                    ]
                ]
            ])
            ->assertOk();

        $this->assertDatabaseHas(UserAnswer::class, [
            'question_answer_id' => $questionAnswer->id,
            'patient_id' => $patient->id
        ]);

        $answers
            ->filter(fn (QuestionAnswer $answer) => $answer->isNot($questionAnswer))
            ->values()
            ->each(function (QuestionAnswer $answer) use ($patient) {
                $this->assertDatabaseMissing(UserAnswer::class, [
                    'question_answer_id' => $answer->id,
                    'patient_id' => $patient->id
                ]);
            });
    }
}
