<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyRevenuesCategory extends Model
{
    protected $table = "company_revenues_categories";

    protected $fillable = [
        'name',
    ];
    public function revenue(){
        return $this->hasMany('\App\Models\CompanyRevenue' , 'category_id');
    }
}
