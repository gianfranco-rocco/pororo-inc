<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Integrations\Puppeteer\DataTransferObjects\PuppeteerThread;
use App\Integrations\Puppeteer\Requests\CreatePuppeteerThreadChatRequest;
use App\Integrations\Puppeteer\Requests\CreatePuppeteerThreadRequest;
use Carbon\CarbonImmutable;
use Domain\Conversations\Models\Conversation;
use Domain\Conversations\Models\Message;
use Domain\Users\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateDailyConversationReportJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(private readonly User $patient)
    {
    }

    public function handle(): void
    {
        $today = CarbonImmutable::today();

        $this
            ->patient
            ->conversationTakeaways()
            ->whereBetween(
                'created_at',
                [$today->startOfDay(), $today->endOfDay()]
            )
            ->delete();

        /** @var Collection<int, Conversation> $conversations */
        $conversations = $this
            ->patient
            ->conversations()
            ->with('messages')
            ->whereBetween(
                'created_at',
                [$today->startOfDay(), $today->endOfDay()]
            )
            ->get();

        $content = "Conversations:\n";

        $conversations->each(function (Conversation $conversation, int $index) use (&$content) {
            $index = $index + 1;

            $content .= "
            -----------------
            #{$index}:\n
            ";

            $conversation
                ->messages
                ->each(function (Message $message) use (&$content) {
                    $messageContent = $message->content();

                    if ($message->isFromAssistant()) {
                        $content .= "Q: {$messageContent}\n";
                    } else {
                        $content .= "A: {$messageContent}\n";
                    }
                });
        });

        /** @var PuppeteerThread $thread */
        $thread = (new CreatePuppeteerThreadRequest())->send()->dto();


        $message = (new CreatePuppeteerThreadChatRequest($thread->id, $content))->send();

        /** @var string $responseMessage */
        $responseMessage = $message->json()['message'];

        /** @var array<string, array<string, string>> */
        $decodedResponse = json_decode($responseMessage);

        if (empty($decodedResponse['response']['takeaways'])) {
            throw new Exception("No takeaways available.");
        }

        /** @var string[] $takeaways */
        $takeaways = $decodedResponse['response']['takeaways'];

        foreach ($takeaways as $takeaway) {
            $this
                ->patient
                ->conversationTakeaways()
                ->create([
                    'takeaway' => $takeaway
                ]);
        }
    }
}
