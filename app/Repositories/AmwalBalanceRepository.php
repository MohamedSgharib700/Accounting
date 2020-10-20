<?php

namespace App\Repositories;

use App\Models\AmwalBalance;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class AmwalBalanceRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function searchFormRequest(Request $request)
    {
        $AmwalBalances = AmwalBalance::orderByDesc("id")
            ->when($request->get('balance'), function ($AmwalBalances) use ($request) {
                return $AmwalBalances->where('balance', 'like', '%' . $request->query->get('balance') . '%');
            })
            ->when($request->get('from_date'), function ($AmwalBalances) use ($request) {
                return $AmwalBalances->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
            })->when($request->get('name'), function ($AmwalBalances) use ($request) {
                return $AmwalBalances->WhereHas('company', function ($AmwalBalances) use ($request) {
                    $AmwalBalances->where('name', 'like', '%' . $request->query->get('name') . '%');
                });
            });


        return $AmwalBalances;
    }

}