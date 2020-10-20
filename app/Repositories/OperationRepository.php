<?php

namespace App\Repositories;

use App\Models\Pos;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class OperationRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $operations = Pos::orderByDesc("id")
            ->when($request->get('serial'), function ($operations) use ($request) {
                return $operations->where('serial', 'like', '%' . $request->query->get('serial') . '%');
            })
            ->when($request->get('created_at'), function ($operations) use ($request) {
                return $operations->whereDate('created_at', 'like', '%' . $request->query->get('created_at') . '%');
            })->when($request->get('code'), function ($operations) use ($request) {
                return $operations->WhereHas('user', function ($operations) use ($request){
                    $operations->where('user_code', 'like', '%' . $request->query->get('code') . '%');
                });
            })->when($request->get('from_date'), function ($operations) use ($request) {
                return $operations->WhereHas('customer', function ($operations) use ($request){
                    $operations->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
                });
            });
            
        return $operations;
    }

}
