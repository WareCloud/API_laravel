<?php

namespace Tests\Feature\Feature;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\EndpointTest;

class LoginTest extends EndpointTest
{
    public function testRequiredFields()
    {
        $errors = [
            'login'     => ['The login field is required.'],
            'password'  => ['The password field is required.']
        ];

        $endpoints = [
            ['endpoint' => '/user/login', 'methods' => ['POST'], 'errors' => $errors]
        ];

        $this->verifyEndpointsFields($endpoints, [], null);
    }

    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('admin')
        ]);

        $data = ['login' => $user->login, 'password' => 'admin'];

        $this->json('POST', '/user/login', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
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
        $data = ['login' => 'admin', 'password' => 'wrong_password'];

        $this->verifyCantAccessEndpoint('POST', '/user/login', 'login_failed', $data,null);
    }
}
