<?php

namespace Tests\Feature\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    public function testRequiresLoginAndPassword()
    {
        $this->json('POST', '/user/login')
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
            'password' => Hash::make('admin')
        ]);

        $payload = ['login' => $user->login, 'password' => 'admin'];

        $this->json('POST', '/user/login', $payload)
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
                    'login' => $user->login
                ]
            ]);
    }

    public function testUserLoginsUnsuccessfully()
    {
        $payload = ['login' => 'admin', 'password' => 'wrong_password'];

        $this->json('POST', '/user/login', $payload)
            ->assertStatus(422)
            ->assertJson([
                'error' => 'These credentials do not match our records.'
            ]);
    }
}
