<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferCreditFromDelegateToCustomers extends Model
{
    use SoftDeletes;
    protected $fillable =[
        'created_by',
        'client_id',
        'pos_id',
        'money',
        'created_date',
        'status',
        'notes',
    ];
    //======================== Start Mohamed Mohsen ====================================//

    public function CreatedBy(){

        return $this->belongsTo(User::class, 'created_by');
    }
    public function Clients(){

        return $this->belongsTo(User::class, 'client_id');
    }
    public function Pos(){

        return $this->belongsTo(Pos::class, 'pos_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    //======================== End Mohamed Mohsen ====================================//
}
