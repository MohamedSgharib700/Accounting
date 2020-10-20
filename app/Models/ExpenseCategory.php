<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table = "expenses_categories";

    protected $fillable = [
        'name',
    ];


    public function expense(){

        return $this->hasmany('\App\Models\Expense' , 'category_id');
    }

}
