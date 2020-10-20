<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundMoneyFromClientToDelegates extends Model
{
    protected $fillable = [
        'client_id','pos_id','delegate_id','value',
        'created_by','created_date','status','done_from_id',
        'done_date'
    ];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function delegate()
    {
        return $this->belongsTo(User::class , 'delegate_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class , 'client_id');
    }
    public function pos()
    {
        return $this->belongsTo(Pos::class , 'pos_id');
    }
    

}
