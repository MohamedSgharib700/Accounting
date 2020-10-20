<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionField extends Model
{
    protected $table = "transaction_field";

    protected $with = "Pos";

    protected $fillable = [
        'user_service_number', 'status' , 'name' , 'value', 'service_id', 'category_id' , 'pos_id', 'created_by', 'created_at','updated_at'
        ,'fees','commissions' , 'serial_card','operation_id'
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
