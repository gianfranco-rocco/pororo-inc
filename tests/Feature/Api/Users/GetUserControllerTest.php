<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Users;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_a_user(): void
    {
        $user = UserFactory::new()->createOne();

        $this
            ->getJson(route('api.users.show', [
                'user' => $user
            ]))
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $user->id
                ]
            ]);
    }
}
