<?php

declare(strict_types=1);

namespace Domain\ThreeWordQAndA\DataTransferObjects;

class WordsDto
{
    public function __construct(
        public readonly string $word1,
        public readonly string $word2,
        public readonly string $word3,
    ) {
    }
}
