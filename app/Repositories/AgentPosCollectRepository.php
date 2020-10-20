<?php

namespace App\Repositories;

use App\Models\AgentPosCollect;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class AgentPosCollectRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $transactions = AgentPosCollect::orderByDesc("id")
        
            ->when($request->get('from_date'), function ($transactions) use ($request) {
                return $transactions->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
            })->when($request->get('serial'), function ($transactions) use ($request) {
                return $transactions->WhereHas('pos', function ($transactions) use ($request){
                    $transactions->where('serial', 'like', '%' . $request->query->get('serial') . '%');
                });
            })->when($request->get('agent'), function ($transactions) use ($request) {
                return $transactions->WhereHas('agent', function ($transactions) use ($request){
                    $transactions->where('name', 'like', '%' . $request->query->get('agent') . '%');
                });
            })->when($request->get('customer'), function ($transactions) use ($request) {
                return $transactions->WhereHas('customer', function ($transactions) use ($request){
                    $transactions->where('name', 'like', '%' . $request->query->get('customer') . '%');
                });
            });
        return $transactions;
    }

}