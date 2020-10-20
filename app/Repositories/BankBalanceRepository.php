<?php

namespace App\Repositories;

use App\Models\SendFromDelegateToBanks;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class BankBalanceRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $bank_balances= SendFromDelegateToBanks::orderByDesc("id")
            ->when($request->get('value'), function ($bank_balances) use ($request) {
                return $bank_balances->where('value', 'like', '%' . $request->query->get('value') . '%');
            })
            ->when($request->get('created_date'), function ($bank_balances) use ($request) {
                return $bank_balances->whereDate('created_at', 'like', '%' . $request->query->get('created_date') . '%');
            });

        return $bank_balances;
    }

}