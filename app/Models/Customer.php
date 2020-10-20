<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    
    // use LaratrustUserTrait;
    use HasApiTokens ;
    // use SoftDeletes ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "customers";

    protected $fillable = [
        'name', 'email', 'password', 'phone' , 'image' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = \Hash::make($pass);
    }
}
