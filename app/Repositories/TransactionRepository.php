<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class TransactionRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $transactions = Transaction::orderByDesc("id")
            ->when($request->get('operation_id'), function ($transactions) use ($request) {
                return $transactions->where('operation_id', 'like', '%' . $request->query->get('operation_id') . '%');
            })
            ->when($request->get('from_date'), function ($transactions) use ($request) {
                return $transactions->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
            })->when($request->get('serial'), function ($transactions) use ($request) {
                return $transactions->WhereHas('pos', function ($transactions) use ($request){
                    $transactions->where('serial', 'like', '%' . $request->query->get('serial') . '%');
                });
            })->when($request->get('company'), function ($transactions) use ($request) {
                return $transactions->WhereHas('company', function ($transactions) use ($request){
                    $transactions->where('name', 'like', '%' . $request->query->get('company') . '%');
                });
            })->when($request->get('name'), function ($transactions) use ($request) {
                return $transactions->WhereHas('pos', function ($transactions) use ($request) {
                    return $transactions->WhereHas('user', function ($transactions) use ($request) {
                        $transactions->where('name', 'like', '%' . $request->query->get('name') . '%');
                    });
                        });
            });
        return $transactions;
    }

}