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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                      => 'required|string|max:191',
            'bundle'                    => 'required|array',
            'bundle.*.software_id'      => 'required|distinct|exists:softwares,id',
            'bundle.*.configuration_id' => 'present|nullable|distinct|exists:configurations,id',
        ]);

        foreach ($data['bundle'] as $bundleData)
        {
            if ($bundleData['configuration_id'] !== null) {
                $conf = Configuration::query()->where([
                    ['id', $bundleData['configuration_id']],
                    ['user_id', Auth::guard('api')->id()],
                    ['software_id', $bundleData['software_id']]
                ])->first();

                if ($conf === null)
                    return response()->json([
                        'error' => 'Forbidden.'
                    ], 403);
            }
        }

        $bundle = Bundle::create([
            'user_id'   => Auth::guard('api')->id(),
            'name'      => $data['name'],
        ]);

        foreach ($data['bundle'] as $bundleData)
            BundleData::create([
                'bundle_id'         => $bundle->id,
                'software_id'       => $bundleData['software_id'],
                'configuration_id'  => $bundleData['configuration_id']
            ]);

        $bundle->load([
            'bundle.software:id,name,vendor,vendor_url',
            'bundle.configuration:id,name'
        ]);

        return response()->json([
            'data' => $bundle
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bundle  $bundle
     * @return \Illuminate\Http\Response
     */
    public function show(Bundle $bundle)
    {
        $this->authorize('view', $bundle);

        $bundle->load([
            'bundle.software:id,name,vendor,vendor_url',
            'bundle.configuration:id,name'
        ]);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bundle  $bundle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bundle $bundle)
    {
        $this->authorize('update', $bundle);

        $data = $request->validate([
            'name'                      => 'required_without:bundle|string|max:191',
            'bundle'                    => 'required_without:name',
            'bundle.*.software_id'      => 'required|distinct|exists:softwares,id',
            'bundle.*.configuration_id' => 'present|nullable|distinct|exists:configurations,id',
        ]);

        if (isset($data['bundle']))
        {
            foreach ($data['bundle'] as $bundleData) {
                if ($bundleData['configuration_id'] !== null) {
                    $conf = Configuration::query()->where([
                        ['id', $bundleData['configuration_id']],
                        ['user_id', Auth::guard('api')->id()],
                        ['software_id', $bundleData['software_id']]
                    ])->first();

                    if ($conf === null)
                        return response()->json([
                            'error' => 'Forbidden.'
                        ], 403);
                }
            }

            \App\BundleData::where('bundle_id', $bundle->id)
                ->delete();

            foreach ($data['bundle'] as $bundleData)
                BundleData::create([
                    'bundle_id'         => $bundle->id,
                    'software_id'       => $bundleData['software_id'],
                    'configuration_id'  => $bundleData['configuration_id']
                ]);
        }

        $bundle->update($data);

        $bundle->load([
            'bundle.software:id,name,vendor,vendor_url',
            'bundle.configuration:id,name'
        ]);

        return ['data' => $bundle];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bundle  $bundle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bundle $bundle)
    {
        $this->authorize('delete', $bundle);

        $bundle->delete();

        return response()->json(null, 204);
    }
}
