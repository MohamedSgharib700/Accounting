<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "areas" ;
    protected $fillable = [
        'name' ,
    ];

    public function users()
    {
       return $this->hasMany('App\Models\User' , 'area_id');
    }

    public function balance(){

        return $this->belongsTo('\App\Models\Balance' , 'area_id');
    }

}
