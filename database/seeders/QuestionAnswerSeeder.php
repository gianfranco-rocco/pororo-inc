<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Questions\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class QuestionAnswerSeeder extends Seeder
{
    public function run(): void
    {
        $questions = array(
            "How have you felt today?" => array(
                "Very happy",
                "Quite content",
                "Neither sad nor happy",
                "A little sad",
                "Quite sad"
            ),
            "At any point today, have you felt lonely?" => array(
                "No",
                "A little",
                "Quite",
                "A lot",
                "Too much"
            ),
            "How did you sleep last night?" => array(
                "Like a baby",
                "Well",
                "So-so",
                "Not very well",
                "Bad, couldn't rest at all"
            ),
            "Do you remember how many hours you slept last night?" => array(
                "More than 8 hours",
                "Between 6 and 8 hours",
                "Between 4 and 6 hours",
                "Between 2 and 4 hours",
                "Less than 2 hours"
            ),
            "Today, have you had any difficulty doing your daily tasks?" => array(
                "None",
                "Two things",
                "Several",
                "Many",
                "All"
            ),
            "How's your appetite today?" => array(
                "Very good",
                "Good",
                "Regular",
                "Not very good",
                "Low"
            ),
            "Today, have you participated in any social activities?" => array(
                "No",
                "Not today, but usually yes",
                "Once",
                "Yes, several times",
                "I never do"
            ),
            "How have your loved ones made you feel today?" => array(
                "Very happy",
                "Happy",
                "Neither good nor bad",
                "A little sad",
                "Quite sad"
            ),
            "Have you had the opportunity to exercise today?" => array(
                "Yes, a good session",
                "Yes, but brief",
                "Not today, but I usually do",
                "Rarely exercise",
                "I never exercise"
            ),
            "Have you had any pain today?" => array(
                "Pain-free",
                "Mild pain",
                "Moderate pain",
                "Quite a bit of pain",
                "A lot of pain"
            ),
            "How would you describe your energy level today?" => array(
                "Very energetic",
                "Quite energetic",
                "Normal",
                "A little low",
                "Very low"
            ),
            "Today, have you noticed any difficulty remembering things?" => array(
                "No, none",
                "A thing or two",
                "A little",
                "Quite a bit",
                "A lot"
            ),
            "In terms of health, how do you feel today?" => array(
                "Fantastic",
                "Well",
                "So-so",
                "Not very well",
                "Bad"
            ),
            "Has it been necessary for you to visit the doctor today?" => array(
                "Yes, it was urgent",
                "Yes, I had an appointment",
                "No, but I usually go regularly",
                "Rarely need to go",
                "Never go"
            ),
            "How do you feel about your future?" => array(
                "Very optimistic",
                "Optimistic",
                "Neutral",
                "Somewhat worried",
                "Very worried"
            ),
            "In terms of emotional support, how have you felt today?" => array(
                "Very supported",
                "Quite supported",
                "Somewhat supported",
                "Little supported",
                "Without support"
            ),
            "Have you had difficulties hearing or understanding conversations today?" => array(
                "None",
                "A few",
                "Some",
                "Quite a few",
                "Many"
            ),
            "How has your social life been just for today?" => array(
                "Very active",
                "Active",
                "Normal",
                "Not very active",
                "Inactive"
            ),
            "How much time have you spent with electronic devices today?" => array(
                "Less than 1 hour",
                "1-2 hours",
                "2-4 hours",
                "4-6 hours",
                "More than 6 hours"
            ),
            "How has your stress level been today?" => array(
                "Completely relaxed",
                "A little stressed",
                "Moderately stressed",
                "Quite stressed",
                "Very stressed"
            ),
            "Have you felt anxiety or worry at any point today?" => array(
                "Not at all",
                "A little",
                "At times",
                "Frequently",
                "All the time"
            ),
            "How have you felt managing your finances today?" => array(
                "Very well",
                "Well",
                "So-so",
                "Not so well",
                "Bad"
            ),
            "Have you been able to enjoy your hobbies or favorite activities today?" => array(
                "Yes, for a long time",
                "Yes, a little while",
                "Not today, but usually yes",
                "Rarely",
                "Never"
            ),
            "Have you had any trouble walking or moving today?" => array(
                "None",
                "A little",
                "Moderate",
                "Quite a bit",
                "A lot"
            ),
            "How's your nutrition been today?" => array(
                "Very nutritious",
                "Good",
                "Normal",
                "Not so good",
                "Poor"
            ),
            "Do you feel that your life has a purpose or meaning today?" => array(
                "Yes, of course",
                "Usually yes",
                "Sometimes",
                "Rarely",
                "Never"
            ),
            "Have you followed your medical recommendations today?" => array(
                "Yes, perfectly",
                "I don't have medical recommendations",
                "So-so",
                "Not very well",
                "Bad"
            ),
            "Today, have you had easy access to transportation when needed?" => array(
                "Always",
                "Most of the time",
                "Sometimes",
                "Rarely",
                "Never"
            ),
            "Have you felt independence and autonomy to do your things today?" => array(
                "Very satisfied",
                "Satisfied",
                "Neutral",
                "Somewhat dissatisfied",
                "Very dissatisfied"
            ),
            "Have you felt overloaded with responsibilities or tasks today?" => array(
                "Not at all",
                "A little",
                "Moderately",
                "Quite",
                "A lot"
            )
        );

        foreach ($questions as $question => $answers) {
            /** @var Question $questionModel */
            $questionModel = Question::create([
                'question' => $question
            ]);

            $answers = Arr::map($answers, fn (string $answer) => $questionModel->answers()->create([
                'answer' => $answer
            ]));
        }
    }
}
