<?php

namespace App\Repositories;

use App\Models\SendFromDelegateToBanks;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class TransferToBankRepository
{
    public function search(Request $request)
    {
        $transfer = SendFromDelegateToBanks::orderByDesc("id")->when($request->get('value'), function ($transfer) use ($request) {
            return $transfer->where('value', 'like', '%' . $request->query->get('value') . '%');
        })->when($request->get('from_date'), function ($transfer) use ($request) {
            return $transfer->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
        })->when($request->get('name'), function ($transfer) use ($request) {
            return $transfer->WhereHas('user', function ($transfer) use ($request){
                $transfer->where('name', 'like', '%' . $request->query->get('name') . '%');
            });
        });
        return $transfer;
    }
}
