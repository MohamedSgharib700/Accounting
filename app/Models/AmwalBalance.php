<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmwalBalance extends Model
{
    protected $table = "add_balance_to_amwal_company";

    protected $fillable = [
        'Balance',
        'company_id',
        'Notes',
    ];

    public function company()
    {
        return $this->belongsTo('\App\Models\Company' , 'company_id' );
    }
}