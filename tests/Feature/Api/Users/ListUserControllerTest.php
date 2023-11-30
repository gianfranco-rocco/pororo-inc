<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Users;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_all_the_users_paginated(): void
    {
        UserFactory::new()->count(30)->create();

        $this
            ->getJson(route('api.users.index'))
            ->assertOk()
            ->assertJsonCount(15, 'data')
            ->assertJson([
                'pagination' => [
                    'total' => 30
                ]
            ]);
    }
}
