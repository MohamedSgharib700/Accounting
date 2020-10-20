<?php

namespace App\Repositories;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class ExpensesRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function searchFormRequest(Request $request)
    {
        $revenues = Expense::orderByDesc("id")
            ->when($request->get('value'), function ($revenues) use ($request) {
                return $revenues->where('value', 'like', '%' . $request->query->get('value') . '%');
            })
            ->when($request->get('from_date'), function ($revenues) use ($request) {
                return $revenues->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
            
            })->when($request->get('category'), function ($revenues) use ($request) {
                return $revenues->WhereHas('category', function ($revenues) use ($request) {
                    $revenues->where('name', 'like', '%' . $request->query->get('category') . '%');
                });
            });
        return $revenues;
    }
}