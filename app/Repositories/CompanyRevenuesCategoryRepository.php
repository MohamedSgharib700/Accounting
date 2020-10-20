<?php

namespace App\Repositories;

use App\Models\CompanyRevenuesCategory;
use Symfony\Component\HttpFoundation\Request;

class CompanyRevenuesCategoryRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $revenues = CompanyRevenuesCategory::orderByDesc("id")
            ->when($request->get('name'), function ($revenues) use ($request) {
                return $revenues->where('name', 'like', '%' . $request->query->get('name') . '%');
            });
        return $revenues;
    }

}
