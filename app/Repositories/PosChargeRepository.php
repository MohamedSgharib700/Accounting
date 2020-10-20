<?php

namespace App\Repositories;

use App\Models\PosCharge;
use Symfony\Component\HttpFoundation\Request;

class PosChargeRepository
{
    public function searchFormRequest(Request $request)
    {
        $charges = PosCharge::orderByDesc("id");

        if ($request->filled('agent_id')) {
            $charges->where('agent_id', $request->get('agent_id'));
        }
        if ($request->filled('pos_id')) {
            $charges->where('pos_id', $request->get('pos_id'));
        }
        if ($request->filled('from_date')) {
            $charges->where('created_at', '>=', $request->get('from_date'));
        }
        if ($request->filled('to_date')) {
            $charges->where('created_at', '<=', $request->get('to_date'));
        }

        return $charges;
    }
}
