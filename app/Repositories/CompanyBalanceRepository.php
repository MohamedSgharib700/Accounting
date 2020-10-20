<?php

namespace App\Repositories;

use App\Models\AgentBalance;
use App\Models\AmwalBalance;
use Symfony\Component\HttpFoundation\Request;

class CompanyBalanceRepository
{
    public function searchFormRequest(Request $request)
    {
        $balances = AmwalBalance::orderByDesc("id")
            ->when($request->get('balance'), function ($balances) use ($request) {
            return $balances->where('balance', 'like', '%' . $request->query->get('balance') . '%');
            })
            ->when($request->get('created_at'), function ($balances) use ($request) {
                return $balances->whereDate('created_at', 'like', '%' . $request->query->get('created_at') . '%');
            });

        return $balances;
    }
}
