<?php

namespace App\Repositories;

use App\Models\CompanyRevenue;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class CompanyRevenuesRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $revenues = CompanyRevenue::orderByDesc("id")
            ->when($request->get('value'), function ($revenues) use ($request) {
                return $revenues->where('value', 'like', '%' . $request->query->get('value') . '%');
            })
            ->when($request->get('from_date'), function ($revenues) use ($request) {
                return $revenues->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
            })->when($request->get('name'), function ($revenues) use ($request) {
                return $revenues->WhereHas('user', function ($revenues) use ($request) {
                    $revenues->where('name', 'like', '%' . $request->query->get('name') . '%');
                });
            })->when($request->get('category'), function ($revenues) use ($request) {
                return $revenues->WhereHas('category', function ($revenues) use ($request) {
                    $revenues->where('name', 'like', '%' . $request->query->get('category') . '%');
                });
            });
        return $revenues;
    }

}
