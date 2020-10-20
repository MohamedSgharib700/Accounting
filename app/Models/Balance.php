<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table = "balances" ; 

    protected $fillable = [ 'User_id','area_id' , 'pos_id' ,  'balance' , 'created_at' ,'updated_at' ,'supervisor' , 'type' ];

    
    public function user(){

        return $this->belongsTo('\App\Models\User' , 'user_id');
    }

    public function area(){

        return $this->belongsTo('\App\Models\Area' , 'area_id');
    }

}
