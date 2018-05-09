<?php

namespace Tests\Feature;

use App\User;
use Tests\EndpointTest;

class ConfigurationTest extends EndpointTest
{
    public function testRequiresLogin()
    {
        $endpoints = [
            ['endpoint' => '/configuration',    'methods' => ['GET', 'POST']],
            ['endpoint' => '/configuration/1',  'methods' => ['GET', 'PUT', 'DELETE']]
        ];

        foreach ($endpoints as $endpoint)
        {
            foreach ($endpoint['methods'] as $method)
                $this->verifyCantAccessEndpoint($method, $endpoint['endpoint'], 'unauthenticated', [], 'wrongtoken');
        }
    }

    public function testCanAccess()
    {
        $token = User::find(1)->generateToken();

        $data = [
            'software_id'   => 1,
            'name'          => 'Test configuration',
            'content'       => 'this is some content'
        ];

        $soft = \App\Software::find(1);

        $this->json('POST', '/configuration', $data, ['Authorization' => "Bearer $token"])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'content',
                    'updated_at',
                    'created_at',
                    'software'
                ]
            ])
            ->assertJson([
                'data' => [
                    'name'          => $data['name'],
                    'content'       => $data['content'],
                    'software'      => [
                        'id'            => $soft->id,
                        'name'          => $soft->name,
                        'vendor'        => $soft->vendor,
                        'vendor_url'    => $soft->vendor_url
                    ]
                ]
            ]);

        $this->json('GET', '/configuration/1', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200);

        $data1 = [
            'content' => 'newcontent'
        ];
        $this->json('PUT', '/configuration/1', $data1, ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'content',
                    'updated_at',
                    'created_at',
                    'software'
                ]
            ])
            ->assertJson([
                'data' => [
                    'name'          => $data['name'],
                    'content'       => $data1['content'],
                    'software'      => [
                        'id'            => $soft->id,
                        'name'          => $soft->name,
                        'vendor'        => $soft->vendor,
                        'vendor_url'    => $soft->vendor_url
                    ]
                ]
            ]);

        $data2 = [
            'name' => 'Test configuration new'
        ];
        $this->json('PUT', '/configuration/1', $data2, ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'content',
                    'updated_at',
                    'created_at',
                    'software'
                ]
            ])
            ->assertJson([
                'data' => [
                    'name'          => $data2['name'],
                    'content'       => $data1['content'],
                    'software'      => [
                        'id'            => $soft->id,
                        'name'          => $soft->name,
                        'vendor'        => $soft->vendor,
                        'vendor_url'    => $soft->vendor_url
                    ]
                ]
            ]);

        $this->json('DELETE', '/configuration/1', $data, ['Authorization' => "Bearer $token"])
            ->assertStatus(204);
    }

    public function testCantAccess()
    {
        $token = factory(User::class)->create()->generateToken();

        $this->verifyCantAccessEndpoint('GET', '/configuration/1', 'forbidden', [], $token);
    }

    public function testRequiredFields()
    {
        $token = User::find(1)->generateToken();

        $errors = [
            [
                'software_id'   => ['The software id field is required.'],
                'name'          => ['The name field is required.'],
                'content'       => ['The content field is required.']
            ],
            [
                'name'          => ['The name field is required when content is not present.'],
                'content'       => ['The content field is required when name is not present.']
            ]
        ];

        $endpoints = [
            ['endpoint' => '/configuration',    'methods' => ['POST'],   'errors' => $errors[0]],
            ['endpoint' => '/configuration/1',  'methods' => ['PUT'],    'errors' => $errors[1]]
        ];

        $this->verifyEndpointsFields($endpoints, [], $token);
    }

    public function testInvalidData()
    {
        $token = User::find(1)->generateToken();

        $errors = [
            'name'          => ['The name must be a string.'],
            'software_id'   => ['The selected software id is invalid.']
        ];

        $endpoints = [
            ['endpoint' => '/configuration', 'methods' => ['POST'], 'errors' => $errors]
        ];

        $datas = [
            ['name' => ['test'],    'software_id' => 0,       'content' => 'this is some content'],
            ['name' => true,        'software_id' => -5,      'content' => 'this is some content'],
            ['name' => 1,           'software_id' => 'test',  'content' => 'this is some content']
        ];

        $this->verifyEndpointsFields($endpoints, $datas, $token);
    }
}