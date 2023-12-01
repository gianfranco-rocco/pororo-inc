<?php

declare(strict_types=1);

namespace App\Transformers\ThreeWordQAndA;

use Domain\ThreeWordQAndA\Models\ThreeWordQAndA;
use Flugg\Responder\Transformers\Transformer;

class ThreeWordQAndATransformer extends Transformer
{
    public function transform(ThreeWordQAndA $game): array
    {
        return [
            'id' => (int) $game->id,
            'user_id' => (int) $game->user_id,
            'sent_at' => $game->sent_at,
            'q_word_1' => $game->q_word_1,
            'q_word_2' => $game->q_word_2,
            'q_word_3' => $game->q_word_3,
            'answered_at' => $game->answered_at,
            'a_word_1' => $game->a_word_1,
            'a_word_2' => $game->a_word_2,
            'a_word_3' => $game->a_word_3,
        ];
    }
}
