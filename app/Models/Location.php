<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table ="locations";

    protected $fillable = [
        'name', 'lon' , 'lat' , 'active'
    ];

    //======================== Start Mohamed Mohsen ====================================//
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function MyPos(){

        return $this->hasMany(Pos::class, 'location_id');
    }
    //======================== End Mohamed Mohsen ====================================//
}
