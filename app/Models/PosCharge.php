<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosCharge extends Model
{
    protected $table = "pos_charges";

    protected $fillable = [
        'customer_id',
        'agent_id',
        'pos_id',
        'value',
    ];
}
