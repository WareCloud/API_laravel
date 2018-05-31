<?php

namespace Tests\Feature;

use App\User;
use Tests\EndpointTest;

class UserTest extends EndpointTest
{
    public function testUpdateUserPasswordSuccessfully()
    {
        $token = User::find(1)->generateToken();

        $data = [
            'password'                  => 'admin',
            'new_password'              => 'newpassword123',
            'new_password_confirmation' => 'newpassword123'
        ];

        $this->json('POST', '/user/password', $data, ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ])
            ->assertJson([
                'data' => 'Password successfully updated.'
            ]);
    }

    public function testRequiresLogin()
    {
        $endpoints = [
            ['endpoint' => '/user',             'methods' => ['GET']],
            ['endpoint' => '/user/password',    'methods' => ['POST']]
        ];

        foreach ($endpoints as $endpoint)
        {
            foreach ($endpoint['methods'] as $method)
                $this->verifyCantAccessEndpoint($method, $endpoint['endpoint'], 'unauthenticated', [], 'wrongtoken');
        }
    }

    public function testGetUser()
    {
        $token = User::find(1)->generateToken();
        $this->json('GET', '/user', [], ['Authorization' => "Bearer $token"])
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
                    'login'     => 'admin',
                    'api_token' => $token
                ]
            ]);
    }

    public function testRequiredFields()
    {
        $token = User::find(1)->generateToken();

        $errors = [
            'password'                  => ['The password field is required.'],
            'new_password'              => ['The new password field is required.'],
            'new_password_confirmation' => ['The new password confirmation field is required.']
        ];

        $endpoints = [
            ['endpoint' => '/user/password', 'methods' => ['POST'], 'errors' => $errors]
        ];

        $this->verifyEndpointsFields($endpoints, [], $token);
    }

    public function testInvalidData()
    {
        $token = User::find(1)->generateToken();

        $errors = [
            'password'                  => ['The password must be a string.'],
            'new_password'              => ['The new password must be a string.', 'The new password must be at least 6 characters.', 'The new password confirmation does not match.'],
            'new_password_confirmation' => ['The new password confirmation must be a string.', 'The new password confirmation must be at least 6 characters.'],
        ];

        $endpoints = [
            ['endpoint' => '/user/password', 'methods' => ['POST'], 'errors' => $errors]
        ];

        $datas = [
            ['password' => 0, 'new_password' => 0, 'new_password_confirmation' => 1]
        ];

        $this->verifyEndpointsFields($endpoints, $datas, $token);
    }
}
