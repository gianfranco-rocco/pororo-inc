<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Users;

use Domain\Users\Enums\Role;
use Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            'role' => Role::PATIENT->value
        ];

        $this
            ->postJson(route('api.users.store'), $data)
            ->assertCreated();

        $this->assertDatabaseHas(User::class, $data);
    }
}
