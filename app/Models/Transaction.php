<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";

    protected $fillable = [
        'user_service_number', 'status' , 'name' , 'value','category_id' , 'pos_id' ,'created_at','updated_at'
    ];

    public function Pos()
    {
        return $this->belongsTo('App\Models\Pos' , 'pos_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company' , 'company_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category' , 'category_id');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service' , 'service_id');
    }

}
