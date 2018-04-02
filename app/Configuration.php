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

    protected $fillable = ['user_id', 'name', 'software_id', 'content'];

    public function software()
    {
        return $this->belongsTo(Software::class);
    }
}
