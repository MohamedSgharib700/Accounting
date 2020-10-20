<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $table = "pos";

    protected $fillable = [
        'user_id', 'machine_code' , 'image' , 'active'
        ,'customer_id','is_closed'
    ];


    public function user()
    {
        return $this->belongsTo('\App\Models\User' , 'user_id' );
    }
    public function customer()
    {
        return $this->belongsTo('\App\Models\User' , 'customer_id' );
    }
    public function balances()
    {
        return $this->hasMany('\App\Models\Balance' , 'pos_id' );
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction' , 'pos_id') ;
    }
    public function TransferMoneyFromDelegateToPos()
    {
        return $this->hasMany('App\Models\TransferCreditFromDelegateToCustomers' , 'pos_id') ;
    }
    
    public function installments()
    {
        return $this->hasMany('App\Models\Installment' , 'pos_id') ;
    }
    public function pos_note()
    {
        return $this->hasMany('App\Models\PosNote' , 'pos_id') ;
    }
    public function commissions()
    {
        return $this->hasMany('App\Models\Commission' , 'pos_id') ;
    }
    public function refundMoney()
    {
        return $this->hasMany('App\Models\RefundMoneyFromClientToDelegates' , 'pos_id') ;
    }
    public function installment()
    {
        return $this->belongsTo('App\Models\Installment' , 'pos_id') ;
    }

    //==== Start Mohamed Mohsen ====================================//
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function scopeIsOpen($query)
    {
        return $query->where('is_closed', 0);
    }
    public function scopeIsclosed($query)
    {
        return $query->where('is_closed', 1);
    }
    public $appends = [
        'available_money',
        //'Transfer money',
        //new

    ];

    public function getAvailableMoneyAttribute()
    {
        $money = TransferCreditFromDelegateToCustomers::where('pos_id',$this->id)
            ->Active()->sum('money');
        $RefundMoneyChicked = RefundMoneyFromClientToDelegates::where('pos_id',$this->id)
            ->Active()->sum('value');
        $TransferFromMachineToMachines = TransferFromMachineToMachines::where('from_pos_id',$this->id)->sum('value');
        $TransferFromMachineToMachines2 = TransferFromMachineToMachines::where('to_pos_id',$this->id)->sum('value');
        $total = ($money -$TransferFromMachineToMachines - $RefundMoneyChicked+$TransferFromMachineToMachines2 );
        return $total;
    }

    //======================== End Mohamed Mohsen ====================================//



}
