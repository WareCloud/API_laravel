<?php

namespace Tests\Feature;

use App\User;
use Tests\EndpointTest;

class LogoutTest extends EndpointTest
{
    public function testCanAccess()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();

        $this->json('POST', '/user/logout', [], ['Authorization' => "Bearer $token"])->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    public function testCantAccess()
    {
        // Simulating login
        $user = factory(User::class)->create();
        $token = $user->generateToken();

        // Simulating logout
        $user->api_token = null;
        $user->save();

        $this->verifyCantAccessEndpoint('POST', '/user/logout', 'unauthenticated', [], $token);
    }
}