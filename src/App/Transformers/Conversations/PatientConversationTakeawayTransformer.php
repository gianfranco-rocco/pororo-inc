<?php

declare(strict_types=1);

namespace App\Transformers\Conversations;

use App\Transformers\Users\UserTransformer;
use Domain\Users\Models\PatientConversationTakeaway;
use Flugg\Responder\Transformers\Transformer;

class PatientConversationTakeawayTransformer extends Transformer
{
    protected $load = [
        'patient' => UserTransformer::class
    ];

    public function transform(PatientConversationTakeaway $takeaway): array
    {
        return [
            'id' => (int) $takeaway->id,
            'takeaway' => $takeaway->takeaway,
        ];
    }
}
