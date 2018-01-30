<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfigurationTest extends TestCase
{
    public function testCanSuccessfullyAccessConfiguration()
    {
        $token = User::find(1)->generateToken();
        $this->json('GET', '/configuration/1', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200);
    }

    public function testCantAccessConfiguration()
    {
        $token = factory(User::class)->create()->generateToken();
        $this->json('GET', '/configuration/1', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(403)
            ->assertJson(['error' => 'Forbidden.']);
    }
}
