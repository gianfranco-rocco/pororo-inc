<?php

declare(strict_types=1);

namespace App\Integrations\Puppeteer\Requests;

use App\Integrations\Puppeteer\DataTransferObjects\PuppeteerMessage;
use App\Integrations\Puppeteer\PuppeteerConnector;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\HasConnector;

class CreatePuppeteerThreadChatRequest extends Request implements HasBody
{
    use HasConnector;
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected string $connector = PuppeteerConnector::class;

    public function __construct(public string $threadId, public string $message)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/chat";
    }

    protected function defaultBody(): array
    {
        /** @var string $config */
        $config = config('puppeteer.config');

        return [
            "thread_id" => $this->threadId,
            "message" => $this->message,
            "streaming" => false,
            "puppeteer_config_name" => $config,
            "start_new_conversation" => false
        ];
    }

    public function createDtoFromResponse(Response $response): PuppeteerMessage
    {
        $data = $response->json();

        /** @var string $content */
        $content = $data['message'];

        return new PuppeteerMessage(
            content: $content,
        );
    }
}
