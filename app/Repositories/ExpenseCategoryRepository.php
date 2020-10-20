<?php

namespace App\Repositories;

use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class ExpenseCategoryRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function searchFormRequest(Request $request)
    {
        $operations = ExpenseCategory::orderByDesc("id")
  
        ->when($request->get('name'), function ($operations) use ($request) {
            return $operations->where('name', 'like', '%' . $request->query->get('name') . '%');
            });
          

        return $operations;
    }

}