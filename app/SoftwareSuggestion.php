<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoftwareSuggestion extends Model
{
    protected $fillable = [
        'name',
        'website'
    ];
}
