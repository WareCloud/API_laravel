<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bundles';

    protected $hidden = [
        'user_id'
    ];

    protected $fillable = [
        'name',
        'user_id',
        'software_id',
        'configuration_id'
    ];

    public function bundle()
    {
        return $this->hasMany(BundleData::class);
    }
}
