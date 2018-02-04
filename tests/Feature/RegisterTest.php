<?php

namespace Tests\Feature;

use Tests\EndpointTest;

class RegisterTest extends EndpointTest
{
    public function testRegistersSuccessfully()
    {
        $data = [
            'login'                 => 'WareCloudTest',
            'password'              => 'WareCloudTest123',
            'password_confirmation' => 'WareCloudTest123'
        ];

        $this->json('POST', '/user/register', $data)
            ->assertStatus(201)
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
                    'login' => $data['login']
                ]
            ]);
    }

    public function testRequiredFields()
    {
        $errors = [
            'login'                 => ['The login field is required.'],
            'password'              => ['The password field is required.'],
            'password_confirmation' => ['The password confirmation field is required.']
        ];

        $endpoints = [
            ['endpoint' => '/user/register', 'methods' => ['POST'], 'errors' => $errors],
        ];

        $this->verifyEndpointsFields($endpoints, [], null);
    }

    public function testLoginAlreadyTaken()
    {
        $datas = [
            ['login' => 'admin', 'password' => 'admin', 'password_confirmation' => 'admin']
        ];


        $errors = [
            'login' => ['The login has already been taken.']
        ];

        $endpoints = [
            ['endpoint' => '/user/register', 'methods' => ['POST'], 'errors' => $errors],
        ];

        $this->verifyEndpointsFields($endpoints, $datas, null);
    }
}