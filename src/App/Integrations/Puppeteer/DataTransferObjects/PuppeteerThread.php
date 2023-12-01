<?php

declare(strict_types=1);

namespace App\Integrations\Puppeteer\DataTransferObjects;

class PuppeteerThread
{
    public function __construct(
        public string $id,
    ) {
    }
}
