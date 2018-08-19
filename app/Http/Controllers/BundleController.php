<?php

namespace App\Http\Controllers;

use App\Bundle;
use App\BundleData;
use App\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class BundleController extends Controller
{
    /**
     * Display all bundles owned by the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the bundles owned by the current user
        $bundles = \App\Bundle::with([
                'bundle.software:id,name,vendor,vendor_url',
                'bundle.configuration:id,name'
            ])
            ->where('user_id', Auth::guard('api')->id())
            ->get();

        return ['data' => $bundles];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created bundle.
     * Requires a bundle name and a list of softwares and configurations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'name'                      => 'required|string|max:191',
            'bundle'                    => 'required|array',
            'bundle.*.software_id'      => 'required|distinct|exists:softwares,id',
            'bundle.*.configuration_id' => 'present|nullable|distinct|exists:configurations,id',
        ]);

        foreach ($data['bundle'] as $bundleData)
        {
            if ($bundleData['configuration_id'] !== null) {
                // Check that the current user is the owner of the specified configuration
                // Check that the configuration match the specified software
                $conf = Configuration::query()->where([
                    ['id', $bundleData['configuration_id']],
                    ['user_id', Auth::guard('api')->id()],
                    ['software_id', $bundleData['software_id']]
                ])->first();

                // If the user is not the owner, or if the configuration doesn't match the software
                // Return 403 status code, Forbidden
                if ($conf === null)
                    return response()->json([
                        'error' => 'Forbidden.'
                    ], 403);
            }
        }

        // Create the bundle and store the informations in database
        $bundle = Bundle::create([
            'user_id'   => Auth::guard('api')->id(),
            'name'      => $data['name'],
        ]);

        // Save the softwares and configurations associated with the bundle in database
        foreach ($data['bundle'] as $bundleData)
            BundleData::create([
                'bundle_id'         => $bundle->id,
                'software_id'       => $bundleData['software_id'],
                'configuration_id'  => $bundleData['configuration_id']
            ]);

        // Load the created bundle and its softwares and configurations' associtations
        $bundle->load([
            'bundle.software:id,name,vendor,vendor_url',
            'bundle.configuration:id,name'
        ]);

        // Return the details of the bundle with a 201 status code
        return response()->json([
            'data' => $bundle
        ], 201);
    }

    /**
     * Display the specified bundle.
     * Requires a bundle name and a list of softwares and configurations.
     *
     * @param  \App\Bundle  $bundle
     * @return \Illuminate\Http\Response
     */
    public function show(Bundle $bundle)
    {
        //Check that the user own the bundle
        $this->authorize('view', $bundle);

        // Load the specified bundle and its softwares and configurations' associtations
        $bundle->load([
            'bundle.software:id,name,vendor,vendor_url',
            'bundle.configuration:id,name'
        ]);

        // Return the specified bundle's details
        return ['data' => $bundle];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bundle  $bundle
     * @return \Illuminate\Http\Response
     */
    public function edit(Bundle $bundle)
    {
        //
    }

    /**
     * Update the specified bundle in storage.
     * Requires a bundle name and a list of softwares and configurations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bundle  $bundle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bundle $bundle)
    {
        //Check that the user own the bundle
        $this->authorize('update', $bundle);

        // Validate the request
        $data = $request->validate([
            'name'                      => 'required_without:bundle|string|max:191',
            'bundle'                    => 'required_without:name',
            'bundle.*.software_id'      => 'required|distinct|exists:softwares,id',
            'bundle.*.configuration_id' => 'present|nullable|distinct|exists:configurations,id',
        ]);

        if (isset($data['bundle']))
        {
            foreach ($data['bundle'] as $bundleData) {
                // Check that the current user is the owner of the specified configuration
                // Check that the configuration match the specified software
                if ($bundleData['configuration_id'] !== null) {
                    $conf = Configuration::query()->where([
                        ['id', $bundleData['configuration_id']],
                        ['user_id', Auth::guard('api')->id()],
                        ['software_id', $bundleData['software_id']]
                    ])->first();

                    // If the user is not the owner, or if the configuration doesn't match the software
                    // Return 403 status code, Forbidden
                    if ($conf === null)
                        return response()->json([
                            'error' => 'Forbidden.'
                        ], 403);
                }
            }

            // Delete the old bundle's softwares and configurations informations
            \App\BundleData::where('bundle_id', $bundle->id)
                ->delete();

            // Store the new softwares and configurations associated to the bundle
            foreach ($data['bundle'] as $bundleData)
                BundleData::create([
                    'bundle_id'         => $bundle->id,
                    'software_id'       => $bundleData['software_id'],
                    'configuration_id'  => $bundleData['configuration_id']
                ]);
        }

        $bundle->update($data);

        // Load the new bundle details
        $bundle->load([
            'bundle.software:id,name,vendor,vendor_url',
            'bundle.configuration:id,name'
        ]);

        // Return the specified bundle's details
        return ['data' => $bundle];
    }

    /**
     * Remove the specified bundle from storage.
     *
     * @param  \App\Bundle  $bundle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bundle $bundle)
    {
        // Check that the current user is the owner of the specified bundle
        $this->authorize('delete', $bundle);

        // Delete the bundle
        $bundle->delete();

        // Return only a 204 status code, no data is returned
        return response()->json(null, 204);
    }
}
