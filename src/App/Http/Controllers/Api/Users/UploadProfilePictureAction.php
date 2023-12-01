<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Users;

use Domain\Users\Models\User;
use Illuminate\Http\UploadedFile;

class UploadProfilePictureAction
{
    public function execute(User $user, UploadedFile $file): void
    {
        /** @var string $disk */
        $disk = config('filesystems.default');
        /** @var string $path */
        $path = $file->store('profile-pictures');

        $user->update([
            'profile_picture_disk' => $disk,
            'profile_picture_path' => $path
        ]);
    }
}
