<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Users;

use App\Http\Requests\Api\Users\StoreUserRequest;
use App\Transformers\Users\UserTransformer;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class StoreUserController
{
    public function __invoke(StoreUserRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = DB::transaction(function () use ($request) {
            /** @var User $user */
            $user = new User((array) $request->validated());

            if ($request->hasFile('profile_picture')) {
                /** @var UploadedFile $file */
                $file = $request->file('profile_picture');

                /** @var string $disk */
                $disk = config('filesystems.default');
                /** @var string $path */
                $path = $file->store('profile-pictures');

                $user->profile_picture_disk = $disk;
                $user->profile_picture_path = $path;
            }

            $user->save();

            if ($user->isPatient()) {
                $user->patientData()->create((array) $request->validated('patient_data'));
            }

            return $user;
        });

        return responder()
            ->success($user, UserTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
