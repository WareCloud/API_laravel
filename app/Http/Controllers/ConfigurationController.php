<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    /**
     * Display all configurations owned by the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all configurations owned by the current user
        $configurations = \App\Configuration::with('software:id,name,vendor,vendor_url')
            ->where('user_id', Auth::guard('api')->id())
            ->get()
            ->makeHidden(['content']);

        // Return the configurations' details
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
     * Store a newly created configuration in storage.
     * Requires a software associated to the configuration, a configuration name and its content
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'software_id'   => 'required|exists:softwares,id',
            'name'          => 'required|string|max:191',
            'content'       => 'required',
            'filename'      => 'required|string|max:191',
            'path'          => 'required|string|max:191'

        ]);

        // Store the the newly created configuration
        $configuration = Configuration::create([
            'user_id'       => Auth::guard('api')->id(),
            'software_id'   => $data['software_id'],
            'name'          => $data['name'],
            'content'       => $data['content'],
            'filename'      => $data['filename'],
            'path'          => $data['path']
        ]);

        // Load the configuration's details
        $configuration->load('software:id,name,vendor,vendor_url');

        // Return the details of the configuration with a 201 status code
        return response()->json([
            'data' => $configuration
        ], 201);
    }

    /**
     * Display the specified configuration.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
        // Check that the current user own the specified configuration
        $this->authorize('view', $configuration);

        // Return the configuration's details
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
    /*
    public function update(Request $request, Configuration $configuration)
    {
        // Check that the current user own the specified configuration
        $this->authorize('update', $configuration);

        $data = $request->validate([
            'name'      => 'string|max:191',
            'content'   => 'string',
            'filename'  => 'string|max:191',
            'path'      => 'string|max:191'
        ]);

        // Update the configuration in database
        $configuration->update($data);

        // Load the new configuration details
        $configuration->load('software:id,name,vendor,vendor_url');

        // Return the configuration's details
        return ['data' => $configuration];
    }
    */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        // Check that the current user own the specified configuration
        $this->authorize('delete', $configuration);

        // Delete the specified configuration
        $configuration->delete();

        // Return only a 204 status code, no data is returned
        return response()->json(null, 204);
    }
}
