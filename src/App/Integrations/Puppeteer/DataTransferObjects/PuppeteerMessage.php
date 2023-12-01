<?php

declare(strict_types=1);

namespace App\Integrations\Puppeteer\DataTransferObjects;

class PuppeteerMessage
{
    public function __construct(
        public string $content,
    ) {
    }
}
