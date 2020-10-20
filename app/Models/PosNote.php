<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosNote extends Model
{
    protected $table = "pos_notes";

    protected $fillable = [
        'pos_id', 'notes' ,'current_agent_id','old_agent_id','status'
    ];
    protected $with=['current_agent','old_agent'];


    public function current_agent()
    {
        return $this->belongsTo('\App\Models\User' , 'current_agent_id' );
    }
    public function old_agent()
    {
        return $this->belongsTo('\App\Models\User' , 'old_agent_id' );
    }

    public function pos()
    {
        return $this->belongsTo('\App\Models\Pos' , 'pos_id' );
    }


}