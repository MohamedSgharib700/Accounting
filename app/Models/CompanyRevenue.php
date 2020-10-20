<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyRevenue extends Model
{
    protected $table = "company_revenues";
    protected $fillable = [
        'value',
        'notes',
        'user_id',
        'agent_id',
        'category_id',
    ];
    public function user(){
        return $this->belongsTo('\App\Models\User' , 'user_id');
    }
    public function category(){
        return $this->belongsTo('\App\Models\CompanyRevenuesCategory' , 'category_id');
    }
    public function agent(){
        return $this->belongsTo('\App\Models\User' , 'agent_id');
    }
}
