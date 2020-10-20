<?php

namespace App\Repositories;

use App\Models\AgentBalance;
use Symfony\Component\HttpFoundation\Request;

class AgentBalanceRepository
{
    public function searchFormRequest(Request $request)
    {
        $balances = AgentBalance::orderByDesc("id")
            ->when($request->get('balance'), function ($balances) use ($request) {
            return $balances->where('balance', 'like', '%' . $request->query->get('balance') . '%');
            })
            ->when($request->get('created_at'), function ($balances) use ($request) {
                return $balances->whereDate('created_at', 'like', '%' . $request->query->get('created_at') . '%');
            })->when($request->get('name'), function ($transactions) use ($request) {
                return $transactions->WhereHas('user', function ($transactions) use ($request) {
                    $transactions->where('name', 'like', '%' . $request->query->get('name') . '%');
                });
            });

        return $balances;
    }
}