<?php

namespace App\Repositories;

use App\Models\Balance;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class BalanceRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {

        $balances = Balance::orderByDesc("id")
            ->when($request->get('User_id'), function ($balances) use ($request) {
                return $balances->where('User_id', 'like', '%' . $request->query->get('User_id') . '%');
            })
            ->when($request->get('area_id'), function ($users) use ($request) {
                return $users->where('area_id', 'like', '%' . $request->query->get('area_id') . '%');
            });

        // if ($request->filled('active')) {
        //     $users->where('active', $request->query->get('active'));
        // }


        return $balances;
    }

}
