<?php

namespace App\Repositories;

use App\Models\Installment;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class InstallmentRepository
{
    public function searchFormRequest(Request $request)
    {

        $transactions = Installment::orderByDesc("id")
             ->when($request->get('name'), function ($transactions) use ($request) {
                return $transactions->WhereHas('agent', function ($transactions) use ($request) {
                    $transactions->where('name', 'like', '%' . $request->query->get('name') . '%');
                });
                }) 
                ->when($request->get('name'), function ($transactions) use ($request) {
                    return $transactions->WhereHas('agent', function ($transactions) use ($request) {
                        $transactions->where('name', 'like', '%' . $request->query->get('name') . '%');
                    });
                    })->when($request->get('contract_name'), function ($transactions) use ($request) {
                    return $transactions->WhereHas('Contract', function ($transactions) use ($request) {
                        $transactions->where('name', 'like', '%' . $request->query->get('contract_name') . '%');
                    });
                    });



    
    return $transactions;
}

}