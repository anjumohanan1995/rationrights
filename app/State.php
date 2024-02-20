<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Eloquent
{
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'states';


    protected $fillable = [
        'name',
       
    ];
}
