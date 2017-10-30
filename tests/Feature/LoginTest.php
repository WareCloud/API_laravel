<?php

namespace Tests\Feature\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/user/login')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'login' => ['The login field is required.'],
                    'password' => ['The password field is required.']
                ]
            ]);
    }

    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'password' => password_hash('admin', PASSWORD_BCRYPT, ['cost' => 12])
        ]);

        $payload = ['login' => $user->login, 'password' => 'admin'];

        $this->json('POST', 'api/user/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'login',
                    'created_at',
                    'updated_at',
                    'api_token'
                ]
            ]);
    }
}
