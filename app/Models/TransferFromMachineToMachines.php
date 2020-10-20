<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferFromMachineToMachines extends Model
{
    protected $fillable =[
        'customer_id',
        'from_pos_id',
        'to_pos_id',
        'value',
        'create_date',
        'status',
    ];
}
