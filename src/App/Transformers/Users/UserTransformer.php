<?php

declare(strict_types=1);

namespace App\Transformers\Users;

use Domain\Users\Models\User;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer
{
    protected $relations = [
        'patientData'
    ];

    protected $load = [];

    public function transform(User $user): array
    {
        return [
            'id' => (int) $user->id,
            'name' => $user->name,
            'last_name' => $user->last_name,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'role' => $user->role,
            'profile_picture_url' => $user->profilePictureUrl()
        ];
    }
}
