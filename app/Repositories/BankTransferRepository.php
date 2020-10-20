<?php

namespace App\Repositories;

use App\Models\BankTransfer;
use Symfony\Component\HttpFoundation\Request;

class BankTransferRepository
{
    public function searchFormRequest(Request $request)
    {
        $transfers = BankTransfer::orderByDesc("id");

        if ($request->filled('agent_id')) {
            $transfers->where('agent_id', $request->get('agent_id'));
        }
        if ($request->filled('from_date')) {
            $transfers->where('created_at', '>=', $request->get('from_date'));
        }
        if ($request->filled('to_date')) {
            $transfers->where('created_at', '<=', $request->get('to_date'));
        }

        return $transfers;
    }
}
