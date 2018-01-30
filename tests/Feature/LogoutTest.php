<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    public function testUserIsLoggedOutProperly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();

        $this->json('POST', '/user/logout', [], ['Authorization' => "Bearer $token"])->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    public function testUserWithNullToken()
    {
        // Simulating login
        $user = factory(User::class)->create();
        $token = $user->generateToken();

        // Simulating logout
        $user->api_token = null;
        $user->save();

        $this->json('POST', '/user/logout', [], ['Authorization' => "Bearer $token"])->assertStatus(401);
    }
}