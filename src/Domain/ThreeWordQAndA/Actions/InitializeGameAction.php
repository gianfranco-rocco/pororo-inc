<?php

declare(strict_types=1);

namespace Domain\ThreeWordQAndA\Actions;

use Domain\ThreeWordQAndA\DataTransferObjects\WordsDto;
use Domain\ThreeWordQAndA\Models\ThreeWordQAndA;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class InitializeGameAction
{
    public function getThreeRandomWords(): WordsDto
    {
        $response = Http::get('https://random-word-api.herokuapp.com/word?number=3');

        $wordsArray = (array) $response->json();

        /** @var array<string> $wordsArray */

        return new WordsDto(...$wordsArray);
    }

    public function execute(int $userId): ThreeWordQAndA
    {
        $words = $this->getThreeRandomWords();

        return ThreeWordQAndA::create([
            'user_id' => $userId,
            'sent_at' => Carbon::now(),
            'q_word_1' => $words->word1,
            'q_word_2' => $words->word2,
            'q_word_3' => $words->word3
        ]);
    }
}
