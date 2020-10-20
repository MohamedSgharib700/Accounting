<?php

namespace App\Repositories;

use App\Models\Area;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class AreaRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {

        $balances = Area::orderByDesc("id")
            ->when($request->get('name'), function ($balances) use ($request) {
                return $balances->where('name', 'like', '%' . $request->query->get('name') . '%');
            });

        // if ($request->filled('active')) {
        //     $users->where('active', $request->query->get('active'));
        // }


        return $balances;
    }

}
