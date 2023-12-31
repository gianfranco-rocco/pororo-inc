<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Conversations;

use App\Jobs\GenerateDailyConversationReportJob;
use App\Transformers\Conversations\ConversationTransformer;
use Carbon\Carbon;
use Domain\Conversations\Models\Conversation;
use Illuminate\Http\JsonResponse;

class CloseConversationController
{
    public function __invoke(Conversation $conversation): JsonResponse
    {
        $conversation->update([
            'closed_at' => Carbon::now(),
        ]);

        GenerateDailyConversationReportJob::dispatch($conversation->patient);

        return responder()
            ->success($conversation, ConversationTransformer::class)
            ->respond();
    }
}
