<?php

namespace App\Http\Controllers;

use App\SoftwareSuggestion;
use App\Notifications\SoftwareSuggestionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoftwareSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'name'      => 'required|string',
            'website'   => 'required|url'
        ]);

        $softwareSuggestion = new SoftwareSuggestion($data);
        $user = Auth::guard('api')->user();

        $user->notify(new SoftwareSuggestionNotification($softwareSuggestion, $user));

        return response()->json(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SoftwareSuggestion  $softwareSuggestion
     * @return \Illuminate\Http\Response
     */
    public function show(SoftwareSuggestion $softwareSuggestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SoftwareSuggestion  $softwareSuggestion
     * @return \Illuminate\Http\Response
     */
    public function edit(SoftwareSuggestion $softwareSuggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SoftwareSuggestion  $softwareSuggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoftwareSuggestion $softwareSuggestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SoftwareSuggestion  $softwareSuggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoftwareSuggestion $softwareSuggestion)
    {
        //
    }
}
