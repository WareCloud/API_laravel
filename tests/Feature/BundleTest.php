<?php

namespace Tests\Feature;

use App\Bundle;
use App\Configuration;
use App\Software;
use App\User;
use Tests\EndpointTest;

class BundleTest extends EndpointTest
{
    public function testRequiresLogin()
    {
        $endpoints = [
            ['endpoint' => '/bundle',    'methods' => ['GET', 'POST']],
            ['endpoint' => '/bundle/1',  'methods' => ['GET', 'PUT', 'DELETE']]
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
            'name' => 'Test bundle 2',
            'bundle' => [
                [
                    'software_id'       => 1,
                    'configuration_id'  => 1
                ],
                [
                    'software_id'       => 2,
                    'configuration_id'  => null
                ],
                [
                    'software_id'       => 3,
                    'configuration_id'  => null
                ]
            ]
        ];

        $softs = [
            Software::find(1),
            Software::find(2),
            Software::find(3)
        ];

        $config = Configuration::find(1);

        $bundleDatas = [
            [
                'software' => [
                    'id'            => $softs[0]->id,
                    'name'          => $softs[0]->name,
                    'vendor'        => $softs[0]->vendor,
                    'vendor_url'    => $softs[0]->vendor_url
                ],
                'configuration' => [
                    'id'    => $config->id,
                    'name'  => $config->name
                ]
            ],
            [
                'software' => [
                    'id'            => $softs[1]->id,
                    'name'          => $softs[1]->name,
                    'vendor'        => $softs[1]->vendor,
                    'vendor_url'    => $softs[1]->vendor_url
                ],
                'configuration' => null
            ],
            [
                'software' => [
                    'id'            => $softs[2]->id,
                    'name'          => $softs[2]->name,
                    'vendor'        => $softs[2]->vendor,
                    'vendor_url'    => $softs[2]->vendor_url
                ],
                'configuration' => null
            ]
        ];

        $this->json('POST', '/bundle', $data, ['Authorization' => "Bearer $token"])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'updated_at',
                    'created_at',
                    'bundle' => [
                        [
                            'software',
                            'configuration'
                        ],
                        [
                            'software',
                            'configuration'
                        ],
                        [
                            'software',
                            'configuration'
                        ]
                    ]
                ]
            ])
            ->assertJson([
                'data' => [
                    'name'      => $data['name'],
                    'bundle'    => $bundleDatas
                ]
            ]);

        $this->json('GET', '/bundle/1', [], ['Authorization' => "Bearer $token"])
            ->assertStatus(200);

        $data1 = [
            'bundle' => [
                [
                    'software_id'       => 1,
                    'configuration_id'  => null
                ]
            ],
        ];
        $this->json('PUT', '/bundle/1', $data1, ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'updated_at',
                    'created_at',
                    'bundle' => [
                        [
                            'software',
                            'configuration'
                        ]
                    ]
                ]
            ])
            ->assertJson([
                'data' => [
                    'name' => Bundle::find(1)->name,
                    'bundle' => [
                        [
                            'software'      => $bundleDatas[0]['software'],
                            'configuration' => null
                        ]
                    ]
                ]
            ]);

        $data2 = [
            'name' => 'Test bundle 2 new'
        ];
        $this->json('PUT', '/bundle/1', $data2, ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'updated_at',
                    'created_at',
                    'bundle' => [
                        [
                            'software',
                            'configuration'
                        ]
                    ]
                ]
            ])
            ->assertJson([
                'data' => [
                    'name' => $data2['name'],
                    'bundle' => [
                        [
                            'software'      => $bundleDatas[0]['software'],
                            'configuration' => null
                        ]
                    ]
                ]
            ]);

        $this->json('PUT', '/bundle/1', $data, ['Authorization' => "Bearer $token"])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'updated_at',
                    'created_at',
                    'bundle' => [
                        [
                            'software',
                            'configuration'
                        ],
                        [
                            'software',
                            'configuration'
                        ],
                        [
                            'software',
                            'configuration'
                        ]
                    ]
                ]
            ])
            ->assertJson([
                'data' => [
                    'name'      => $data['name'],
                    'bundle'    => $bundleDatas
                ]
            ]);

        $this->json('DELETE', '/bundle/1', $data, ['Authorization' => "Bearer $token"])
            ->assertStatus(204);
    }

    public function testCantAccess()
    {
        $token = factory(User::class)->create()->generateToken();

        $this->verifyCantAccessEndpoint('GET', '/bundle/1', 'forbidden', [], $token);
    }

    public function testRequiredFields()
    {
        $token = User::find(1)->generateToken();

        $errors = [
            [
                'name'      => ['The name field is required.'],
                'bundle'    => ['The bundle field is required.']
            ],
            [
                'name'      => ['The name field is required when bundle is not present.'],
                'bundle'    => ['The bundle field is required when name is not present.']
            ]
        ];

        $endpoints = [
            ['endpoint' => '/bundle',    'methods' => ['POST'],   'errors' => $errors[0]],
            ['endpoint' => '/bundle/1',  'methods' => ['PUT'],    'errors' => $errors[1]]
        ];
        $this->verifyEndpointsFields($endpoints, [], $token);

        $errors1 = [
            'bundle.0.software_id'      => ['The bundle.0.software_id field is required.'],
            'bundle.0.configuration_id' => ['The bundle.0.configuration_id field must be present.']
        ];

        $data1 = [
            ['bundle' => [true]]
        ];

        $endpoints1 = [
            ['endpoint' => '/bundle/1', 'methods' => ['PUT'], 'errors' => $errors1]
        ];
        $this->verifyEndpointsFields($endpoints1, $data1, $token);

    }

    public function testInvalidData()
    {
        $token = User::find(1)->generateToken();

        $errors = [
            'name'      => ['The name must be a string.'],
            'bundle'    => ['The bundle must be an array.']
        ];

        $endpoints = [
            ['endpoint' => '/bundle', 'methods' => ['POST'], 'errors' => $errors]
        ];

        $datas = [
            ['name' => true,    'bundle' => true],
            ['name' => 1,       'bundle' => 1]
        ];
        $this->verifyEndpointsFields($endpoints, $datas, $token);

        $errors1 = [
            'bundle.0.software_id'      => ['The selected bundle.0.software_id is invalid.'],
            'bundle.0.configuration_id' => ['The selected bundle.0.configuration_id is invalid.']
        ];

        $endpoints1 = [
            ['endpoint' => '/bundle',   'methods' => ['POST'],  'errors' => $errors1],
            ['endpoint' => '/bundle/1', 'methods' => ['PUT'],   'errors' => $errors1]
        ];

        $datas1 = [
            ['name' => 'test',  'bundle' => [['software_id' => 'test',  'configuration_id' => 'test']]],
            ['name' => 'test',  'bundle' => [['software_id' => -1,      'configuration_id' => -1]]]
        ];
        $this->verifyEndpointsFields($endpoints1, $datas1, $token);

        $user = factory(User::class)->create();

        $conf = Configuration::create([
            'user_id'       => $user->id,
            'software_id'   => 1,
            'name'          => 'test',
            'content'       => 'test'
        ]);

        $datas2 = ['name' => 'test',  'bundle' => [['software_id' => 1,  'configuration_id' => $conf->id]]];
        $this->verifyCantAccessEndpoint('POST', '/bundle', 'forbidden', $datas2, $token);
        $this->verifyCantAccessEndpoint('PUT', '/bundle/1', 'forbidden', $datas2, $token);

        $token3 = $user->generateToken();

        $bundle = Bundle::create([
            'user_id'   => $user->id,
            'name'      => 'test'
        ]);

        $this->be($user);
        $datas3 = ['name' => 'test',  'bundle' => [['software_id' => 2,  'configuration_id' => $conf->id]]];
        $this->verifyCantAccessEndpoint('POST', '/bundle', 'forbidden', $datas3, $token3);
        $this->verifyCantAccessEndpoint('PUT', '/bundle/'.$bundle->id, 'forbidden', $datas3, $token3);
    }
}