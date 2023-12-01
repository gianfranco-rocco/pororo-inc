<?php

declare(strict_types=1);

namespace App\Integrations\Puppeteer\Requests;

use App\Integrations\Puppeteer\DataTransferObjects\PuppeteerThread;
use App\Integrations\Puppeteer\PuppeteerConnector;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\HasConnector;

class CreatePuppeteerThreadRequest extends Request
{
    use HasConnector;

    protected Method $method = Method::POST;

    protected string $connector = PuppeteerConnector::class;

    public function resolveEndpoint(): string
    {
        return "/create_thread";
    }

    public function createDtoFromResponse(Response $response): PuppeteerThread
    {
        $data = $response->json();

        /** @var string $id */
        $id = $data['thread_id'];

        return new PuppeteerThread(
            id: $id,
        );
    }
}
