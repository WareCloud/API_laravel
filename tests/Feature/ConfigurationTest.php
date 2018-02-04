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
            'content'       => 'this is some content'
        ];

        $this->json('POST', '/configuration', $data, ['Authorization' => "Bearer $token"])
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
                    'user_id'       => 1,
                    'software_id'   => 1,
                    'content'       => $data['content']
                ]
            ]);

        $this->json('GET', '/configuration/1', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200);

        $data = [
            'content' => 'newcontent'
        ];
        $this->json('PUT', '/configuration/1', $data, ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
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
                    'user_id'       => 1,
                    'software_id'   => 1,
                    'content'       => $data['content']
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
            'software_id'   => ['software_id'   => ['The software id field is required.']],
            'content'       => ['content'       => ['The content field is required.']]
        ];

        $endpoints = [
            ['endpoint' => '/configuration',    'methods' => ['POST'],   'errors' => $errors['software_id'] + $errors['content']],
            ['endpoint' => '/configuration/1',  'methods' => ['PUT'],    'errors' => $errors['content']]
        ];

        $this->verifyEndpointsFields($endpoints, [], $token);
    }

    public function testInvalidData()
    {
        $token = User::find(1)->generateToken();

        $errors = [
            'software_id' => ['The selected software id is invalid.']
        ];

        $endpoints = [
            ['endpoint' => '/configuration', 'methods' => ['POST'], 'errors' => $errors]
        ];

        $datas = [
            [ 'software_id' => 0,       'content' => 'this is some content'],
            [ 'software_id' => -5,      'content' => 'this is some content'],
            [ 'software_id' => 'test',  'content' => 'this is some content']
        ];

        $this->verifyEndpointsFields($endpoints, $datas, $token);
    }
}