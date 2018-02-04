<?php

namespace Tests;

abstract class EndpointTest extends TestCase
{
    public function verifyWrongData($method, $endpoint, $errors, $data, $token)
    {
        $this->json($method, $endpoint, $data, $token ? ['Authorization' => "Bearer $token"] : [])
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => $errors
        ]);
    }

    public function verifyCantAccessEndpoint($method, $endpoint, $reason, $data, $token)
    {
        $reasons = [
            'forbidden'         => ['status' => 403, 'error' => 'Forbidden.'],
            'unauthenticated'   => ['status' => 401, 'error' => 'Unauthenticated.'],
            'login_failed'      => ['status' => 422, 'error' => 'These credentials do not match our records.']
        ];

        $this->json($method, $endpoint, $data, $token !== null ? ['Authorization' => "Bearer $token"] : [])
            ->assertStatus($reasons[$reason]['status'])
            ->assertJson(['error' => $reasons[$reason]['error']]);
    }

    public function verifyEndpointsFields($endpoints, $datas, $token)
    {
        foreach ($endpoints as $endpoint)
        {
            foreach ($endpoint['methods'] as $method)
            {
                if ($datas === [])
                    $this->verifyWrongData($method, $endpoint['endpoint'], $endpoint['errors'], $datas, $token);
                else
                {
                    foreach ($datas as $data)
                        $this->verifyWrongData($method, $endpoint['endpoint'], $endpoint['errors'], $data, $token);
                }
            }
        }
    }
}
