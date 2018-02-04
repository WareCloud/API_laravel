<?php

namespace Tests\Feature;

use App\User;
use Tests\EndpointTest;

class UserTest extends EndpointTest
{
    public function testRequiresLogin()
    {
        $this->verifyCantAccessEndpoint('GET', '/user', 'unauthenticated', [], null);
    }

    public function testGetUser()
    {
        $token = User::find(1)->generateToken();
        $this->json('GET', '/user', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'login',
                    'created_at',
                    'updated_at',
                    'api_token'
                ]
            ])
            ->assertJson([
                'data' => [
                    'id'        => 1,
                    'login'     => 'admin',
                    'api_token' => $token
                ]
            ]);
    }
}
