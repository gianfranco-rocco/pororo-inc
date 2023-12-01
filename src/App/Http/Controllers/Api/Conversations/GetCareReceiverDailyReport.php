<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Conversations;

use App\Transformers\Conversations\PatientConversationTakeawayTransformer;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;

class GetCareReceiverDailyReport
{
    public function __invoke(User $caregiver): JsonResponse
    {
        $takeaways = $caregiver->careReceivers()->first()?->conversationTakeaways;

        return responder()
            ->success($takeaways, PatientConversationTakeawayTransformer::class)
            ->respond();
    }
}
