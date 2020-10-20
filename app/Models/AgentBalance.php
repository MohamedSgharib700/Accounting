<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentBalance extends Model
{
    protected $table = "agent_balances";

    protected $fillable = [
        'agent_id',
        'balance',
        'supervisor',
    ];


    public function user(){

        return $this->belongsTo('\App\Models\User' , 'agent_id');
    }
}
