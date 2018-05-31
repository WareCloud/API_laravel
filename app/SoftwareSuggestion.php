<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class SoftwareSuggestion extends SlackNotificationContent
{
    public function __construct(array $attributes = [])
    {
        $content = [
            'url'       => env('SOFTWARESUGGESTION_SLACK_WEBHOOK_URL'),
            'level'     => 'success',
            'user'      => env('SOFTWARESUGGESTION_SLACK_WEBHOOK_USER'),
            'icon'      => env('SOFTWARESUGGESTION_SLACK_WEBHOOK_ICON'),
            'channel'   => env('SOFTWARESUGGESTION_SLACK_WEBHOOK_CHANNEL'),
            'content'   => 'A new software suggestion as been submitted !',
            'title'     => 'Software Suggestion',
            'fields'    => [
                'User'      => Auth::guard('api')->user()->login,
                'Name'      => $attributes['name'],
                'Website'   => $attributes['website']
            ]
        ];

        parent::__construct($content);
    }
}
