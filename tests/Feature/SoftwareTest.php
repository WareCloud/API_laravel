<?php

namespace Tests\Feature;

use App\User;
use Tests\EndpointTest;

class SoftwareTest extends EndpointTest
{
    public function testGetSoftwares()
    {
        $token = User::find(1)->generateToken();
        $this->json('GET', '/software', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'version',
                        'vendor',
                        'vendor_url',
                        'comment',
                        'download_url'
                    ]
                ]
            ]);
    }

    public function testGetSoftware()
    {
        $token = User::find(1)->generateToken();
        $this->json('GET', '/software/1', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'version',
                    'vendor',
                    'vendor_url',
                    'comment',
                    'download_url'
                ]
            ]);
    }

    public function testRequiresLogin()
    {
        $endpoints = [
            ['endpoint' => '/software',     'methods' => ['GET']],
            ['endpoint' => '/software/1',   'methods' => ['GET']]
        ];

        foreach ($endpoints as $endpoint)
        {
            foreach ($endpoint['methods'] as $method)
                $this->verifyCantAccessEndpoint($method, $endpoint['endpoint'], 'unauthenticated', [], 'wrongtoken');
        }
    }
}
