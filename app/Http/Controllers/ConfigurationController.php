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
        $configurations = Configuration::all();
        $list = [];
        foreach ($configurations as $config) {
            $software = Software::find($config['software_id']);
            $temp = [
                "configuration_id" => $config['id'],
                "software" => $software,
                "created_at" => $config['created_at'],
                "updated_at" => $config['updated_at']
            ];
            array_push($list, $temp);
        }

        return response()->json([
            'data' => $list
        ], 200);
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
            'software_id' => 'required|exists:softwares,id',
            'content' => 'required'
        ]);
        $configuration = Configuration::create([
            'user_id' => Auth::guard('api')->id(),
            'software_id' => $data['software_id'],
            'content' => $data['content']
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}
