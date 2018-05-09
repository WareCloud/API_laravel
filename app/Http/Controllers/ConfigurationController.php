<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurations = \App\Configuration::with('software:id,name,vendor,vendor_url')
            ->where('user_id', Auth::guard('api')->user()->id)
            ->get()
            ->makeHidden(['content']);

        return ['data' => $configurations];
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
            'software_id'   => 'required|exists:softwares,id',
            'name'          => 'required|string|max:191',
            'content'       => 'required'
        ]);

        $configuration = Configuration::create([
            'user_id'       => Auth::guard('api')->id(),
            'software_id'   => $data['software_id'],
            'name'          => $data['name'],
            'content'       => $data['content']
        ]);

        $configuration->load('software:id,name,vendor,vendor_url');

        return response()->json([
            'data' => $configuration
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        $this->authorize('view', $configuration);

        return $configuration->content;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuration $configuration)
    {
        $this->authorize('update', $configuration);

        $data = $request->validate([
            'name'      => 'required_without:content|string|max:191',
            'content'   => 'required_without:name'
        ]);

        $configuration->update($data);

        $configuration->load('software:id,name,vendor,vendor_url');

        return ['data' => $configuration];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        $this->authorize('delete', $configuration);

        $configuration->delete();

        return response()->json(null, 204);
    }
}
