<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configurations';

    protected $fillable = ['user_id', 'software_id', 'content'];
}
