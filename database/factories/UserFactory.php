<?php

declare(strict_types=1);

namespace Database\Factories;

use Domain\Users\Enums\Role;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'role' => fake()->randomElement(Role::cases()),
            'remember_token' => Str::random(10),
            'caregiver_id' => null,
        ];
    }

    public function patient(): static
    {
        return $this->state(fn () => [
            'role' => Role::PATIENT
        ]);
    }

    public function caregiver(): static
    {
        return $this->state(fn () => [
            'role' => Role::CAREGIVER
        ]);
    }
}
