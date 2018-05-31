<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class BugReport extends SlackNotificationContent
{
    public function __construct(array $attributes = [])
    {
        $content = [
            'url'       => env('BUGREPORT_SLACK_WEBHOOK_URL'),
            'level'     => 'error',
            'user'      => env('BUGREPORT_SLACK_WEBHOOK_USER'),
            'icon'      => env('BUGREPORT_SLACK_WEBHOOK_ICON'),
            'channel'   => env('BUGREPORT_SLACK_WEBHOOK_CHANNEL'),
            'content'   => 'A new bug report has been submitted !',
            'title'     => 'Bug Report',
            'fields'    => [
                'User'          => Auth::guard('api')->user()->login,
                'Title'         => $attributes['title'],
                'Description'   => $attributes['description']
            ]
        ];

        parent::__construct($content);
    }
}
