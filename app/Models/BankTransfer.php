<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    protected $table = "bank_transfers";

    protected $fillable = [
        'agent_id',
        'value',
        'transfer_number',
        'receipt',
    ];
}
