<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function testRequiresLogin()
    {
        $this->json('GET', '/user')
            ->assertStatus(401)
            ->assertJson(['error' => 'Unauthenticated.']);
    }

    public function testGetUser()
    {
        $token = User::find(1)->generateToken();
        $this->json('GET', '/user', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'login',
                'created_at',
                'updated_at',
                'api_token'
            ])
            ->assertJson([
                'id' => 1,
                'login' => 'admin',
                'api_token' => $token
            ]);
    }
}
