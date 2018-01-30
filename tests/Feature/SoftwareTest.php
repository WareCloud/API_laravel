<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SoftwareTest extends TestCase
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
        $this->json('GET', '/software')
            ->assertStatus(401)
            ->assertJson(['error' => 'Unauthenticated.']);

        $this->json('GET', '/software/1')
            ->assertStatus(401)
            ->assertJson(['error' => 'Unauthenticated.']);
    }
}
