<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = "expenses";

    protected $fillable = [
        'category_id',
        'user_id',
        'value',
        'note',
    ];


    public function category(){

        return $this->belongsTo('\App\Models\ExpenseCategory' , 'category_id');
    }

}
