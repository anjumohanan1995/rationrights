<?php

namespace App;
use App\Models\MbaApplication;




use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait,SoftDeletes;

    protected $connection = 'mongodb';


    protected $collection = 'users';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'name', 'email', 'password','email','role','image','student_id','password_reset_token','state'
    ];

     protected $hidden = [
        'password', 'remember_token',
    ];

     protected $casts = [
        'email_verified_at' => 'datetime',
    ];



     public function MbaApplication()
    {
        // return $this->hasOne(MbaApplication::class, 'student_id', '_id');
        return $this->hasOne(MbaApplication::class, '_id', 'student_id');
    }





}

