<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BundleData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bundle_datas';

    public $timestamps = false;

    protected $hidden = [
        'bundle_id',
        'software_id',
        'configuration_id'
    ];

    protected $fillable = [
        'bundle_id',
        'software_id',
        'configuration_id'
    ];

    public function software()
    {
        return $this->belongsTo(Software::class);
    }

    public function configuration()
    {
        return $this->belongsTo(Configuration::class);
    }
}
