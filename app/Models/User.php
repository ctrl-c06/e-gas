<?php

namespace App\Models;


use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'firstname', 'middlename', 'lastname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setFirstnameAttribute($value)
    {
        return $this->attributes['firstname'] = Str::upper($value);
    }

    public function setMiddlenameAttribute($value)
    {
        return $this->attributes['middlename'] = Str::upper($value);
    }

    public function setLastnameAttribute($value)
    {
        return $this->attributes['lastname'] = Str::upper($value);
    }

}
