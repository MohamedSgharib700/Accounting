<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentPosCollect extends Model
{
    protected $table = "agent_pos_collects";

    protected $fillable = [
        'customer_id',
        'agent_id',
        'pos_id',
        'value',
        'customer_id',
        'notes'

    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class, 'pos_id');
    }

}