<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    public function testRegistersSuccessfully()
    {
        $payload = [
            'login' => 'WareCloudTest',
            'password' => 'WareCloudTest123',
            'password_confirmation' => 'WareCloudTest123'
        ];

        $this->json('POST', '/user/register', $payload)
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
                    'login' => $payload['login']
                ]
            ]);
    }

    public function testRequiresLoginAndPassword()
    {
        $this->json('POST', '/user/register')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'login' => ['The login field is required.'],
                    'password' => ['The password field is required.']
                ]
            ]);
    }

    public function testRequiresPasswordConfirmation()
    {
        $payload = [
            'login' => 'WareCloudTest',
            'password' => 'WareCloudTestl123'
        ];

        $this->json('POST', '/user/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => ['The password confirmation does not match.']
                ]
            ]);
    }

    public function testLoginAlreadyTaken()
    {
        $payload = [
            'login' => 'admin',
            'password' => 'admin'
        ];

        $this->json('POST', '/user/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'login' => ['The login has already been taken.']
                ]
            ]);
    }
}