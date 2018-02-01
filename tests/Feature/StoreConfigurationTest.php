<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;


class StoreConfigurationTest extends TestCase
{
    public function testStoreConfig()
    {
        $token = User::find(1)->generateToken();

        $payload = [
            'software_id' => 1,
            'content' => "this is some content"
        ];

        $this->json('POST', '/configuration', $payload, ['Authorization' => "Bearer $token"])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'user_id',
                    'software_id',
                    'content',
                    'updated_at',
                    'created_at',
                    'id'
                ]
            ])
            ->assertJson([
                'data' => [
                    'content' => $payload['content']
                ]
            ]);
    }

    public function testNoPayload()
    {
        $token = User::find(1)->generateToken();

        $this->json('POST', '/configuration', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'software_id' => [
                        'The software id field is required.'
                    ],
                    'content' => [
                        'The content field is required.'
                    ]
                ]
            ]);
    }

    public function testNoSoftwareId()
    {
        $token = User::find(1)->generateToken();

        $payload = [
            'content' => "this is some content"
        ];

        $this->json('POST', '/configuration', $payload, ['Authorization' => "Bearer $token"])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'software_id' => [
                        'The software id field is required.'
                    ]
                ]
            ]);
    }

    public function testNoContent()
    {
        $token = User::find(1)->generateToken();

        $payload = [
            'software_id' => 1
        ];

        $this->json('POST', '/configuration', $payload, ['Authorization' => "Bearer $token"])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'content' => [
                        'The content field is required.'
                    ]
                ]
            ]);
    }

    public function testWrongSoftwareId()
    {
        $token = User::find(1)->generateToken();

        $payload1 = [
            'software_id' => 11,
            'content' => "this is some content"
        ];

        $payload2 = [
            'software_id' => 11
        ];

        $payload3 = [
            'software_id' => -5
        ];

        $this->json('POST', '/configuration', $payload1, ['Authorization' => "Bearer $token"])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'software_id' => [
                        'The selected software id is invalid.'
                    ]
                ]
            ]);
        $this->json('POST', '/configuration', $payload2, ['Authorization' => "Bearer $token"])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'software_id' => [
                        'The selected software id is invalid.'
                    ],
                    "content" => [
                        "The content field is required."
                    ]
                ]
            ]);

        $this->json('POST', '/configuration', $payload3, ['Authorization' => "Bearer $token"])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'software_id' => [
                        'The selected software id is invalid.'
                    ],
                    "content" => [
                        "The content field is required."
                    ]
                ]
            ]);
    }

    public function testRequiresLogin()
    {
        $wrongToken = "wrongtoken";
        $payload = [
            'software_id' => 1,
            'content' => "this is some content"
        ];

        $this->json('POST', '/configuration')
            ->assertStatus(401)
            ->assertJson(['error' => 'Unauthenticated.']);

        $this->json('POST', '/configuration', [],['Authorization' => "Bearer $wrongToken"])
            ->assertStatus(401)
            ->assertJson(['error' => 'Unauthenticated.']);

        $this->json('POST', '/configuration', $payload,['Authorization' => "Bearer $wrongToken"])
            ->assertStatus(401)
            ->assertJson(['error' => 'Unauthenticated.']);

    }

}