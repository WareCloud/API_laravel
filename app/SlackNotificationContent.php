<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlackNotificationContent extends Model
{
    protected $fillable = [
        'url',
        'level',
        'user',
        'icon',
        'channel',
        'content',
        'title',
        'fields'
    ];
}
