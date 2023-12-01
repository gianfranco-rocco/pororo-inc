<?php

declare(strict_types=1);

namespace App\Integrations\Puppeteer;

use Saloon\Http\Connector;

class PuppeteerConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        /** @var string $url */
        $url = config('puppeteer.base_url');

        return $url;
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => 60,
        ];
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => config('puppeteer.api_key')
        ];
    }
}
