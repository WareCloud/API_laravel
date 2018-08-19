<?php

namespace App\Http\Controllers;

use App\BugReport;
use App\Notifications\SlackNotification;
use App\Notify;
use Illuminate\Http\Request;

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
     * Send a bug report notification to Slack
     * Requires a bug title and a description
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'title'         => 'required|string',
            'description'   => 'required|string'
        ]);

        // Send a Slack notification
        (new Notify)->notify(new SlackNotification(new BugReport($data)));

        // Return a confirmation message
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
