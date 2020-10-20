<?php

namespace App\Repositories;

use App\Models\FinancialCustoday;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class FinancialCustodayRepository
{
    public function searchFormRequest(Request $request)
    {

        $transactions = FinancialCustoday::orderByDesc("id")
             ->when($request->get('name'), function ($transactions) use ($request) {
                    return $transactions->WhereHas('customer', function ($transactions) use ($request) {
                    $transactions->where('name', 'like', '%' . $request->query->get('name') . '%');
                });
                }) 
                ->when($request->get('from_date'), function ($transactions) use ($request) {
                    return $transactions->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
                })
                ->when($request->get('name'), function ($transactions) use ($request) {
                    return $transactions->WhereHas('customer', function ($transactions) use ($request) {
                    $transactions->where('name', 'like', '%' . $request->query->get('name') . '%');
                    });
                    })
                ->when($request->get('contract_name'), function ($transactions) use ($request) {
                 return $transactions->WhereHas('Contract', function ($transactions) use ($request) {
                    $transactions->where('name', 'like', '%' . $request->query->get('contract_name') . '%');
                    });
                    });



    
    return $transactions;
}

}