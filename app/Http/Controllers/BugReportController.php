<?php

namespace App\Http\Controllers;

use App\BugReport;
use App\Notifications\BugReportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BugReportController extends Controller
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
            'title'         => 'required|string',
            'description'   => 'required|string'
        ]);

        $bugReport = new BugReport($data);
        $user = Auth::guard('api')->user();

        $user->notify(new BugReportNotification($bugReport, $user));

        return response()->json([
            'data' => 'Bug report successfully submitted.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BugReport  $bugReport
     * @return \Illuminate\Http\Response
     */
    public function show(BugReport $bugReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BugReport  $bugReport
     * @return \Illuminate\Http\Response
     */
    public function edit(BugReport $bugReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BugReport  $bugReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BugReport $bugReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BugReport  $bugReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(BugReport $bugReport)
    {
        //
    }
}
