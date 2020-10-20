<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $table = "installments";

    protected $fillable = [
        'customer_id',
        'agent_id',
        'pos_id',
        'contract_id',
        'value',
        'due_date' ,
        'payment_date',
        'status'
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

    public function Contract()
    {
        return $this->belongsTo('App\Models\ContractType' , 'contract_id');
    }
}
