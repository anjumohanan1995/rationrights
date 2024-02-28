<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Eloquent
{
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'applications';


    protected $fillable = [
        'name',
        'address',
        'age',
        'gender',
        'mobile',
        'years',
        'aadhaar',
        'eligibility',
        'ration',
        'district',
        'location',
        'type',
        'home_district',
        'home_state',
        'application_no',
        'location_id',
        'state',
        'user_id',
        'old_type','updated_by'
    ];
}
