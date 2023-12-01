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
    public function __invoke(
        StoreUserRequest $request,
        UploadProfilePictureAction $uploadProfilePictureAction,
    ): JsonResponse {
        /** @var User $user */
        $user = DB::transaction(function () use ($request, $uploadProfilePictureAction) {
            /** @var User $user */
            $user = User::create((array) $request->except('profile_picture'));

            /** @var UploadedFile|null $file */
            $file = $request->file('profile_picture');

            if ($file) {
                $uploadProfilePictureAction->execute($user, $file);
            }

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
