<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'category_id', 'image', 'active' 
    ];


    public function category()
    {

        return $this->belongsTo('\App\Models\Category' , 'category_id' );

    }
}
