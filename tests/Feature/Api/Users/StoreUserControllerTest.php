<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Users;

use Domain\Users\Enums\Role;
use Domain\Users\Models\PatientData;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreUserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_creates_a_user(): void
    {
        $data = [
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'role' => Role::CAREGIVER->value
        ];

        $this
            ->postJson(route('api.users.store'), $data)
            ->assertCreated();

        $this->assertDatabaseHas(User::class, $data);
    }

    public function test_it_creates_a_user_and_uploads_their_profile_picture(): void
    {
        /** @var string $disk */
        $disk = config('filesystems.default');

        Storage::fake($disk);

        $data = [
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'role' => Role::CAREGIVER->value,
            'profile_picture' => UploadedFile::fake()->image('image.jpg')
        ];

        /** @var array $response */
        $response = $this
            ->postJson(route('api.users.store'), $data)
            ->assertCreated()
            ->baseResponse
            ->original;

        unset($data['profile_picture']);

        $this->assertDatabaseHas(User::class, $data);

        /** @var User $user */
        $user = User::find($response['data']['id']);

        Storage::assertExists((string) $user->profile_picture_path);
    }

    public function test_it_creates_patient_and_stores_their_data(): void
    {
        $patientData = [
            'conditions' => 'Condition 1, Condition 2, Something really bad',
            'weight' => '100kg',
            'height' => '172cm',
            'birth_date' => '2000-10-10',
        ];

        $data = [
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'role' => Role::PATIENT->value,
        ];

        $this
            ->postJson(route('api.users.store'), [
                ...$data,
                'patient_data' => $patientData
            ])
            ->assertCreated();

        $this->assertDatabaseHas(User::class, $data);

        /** @var User $user */
        $user = User::latest('id')->first();

        $this->assertDatabaseHas(PatientData::class, [
            ...$patientData,
            'patient_id' => $user->id
        ]);
    }
}
