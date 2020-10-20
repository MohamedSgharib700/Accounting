<?php

namespace App\Repositories;

use App\Models\Revenue;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class RevenueRepository
{
    public function searchFormRequest(Request $request)
    {
        $revenues = Revenue::orderByDesc("id");

        if ($request->filled('agent_id')) {
            $revenues->where('agent_id', $request->get('agent_id'));
        }
        if ($request->filled('pos_id')) {
            $revenues->where('pos_id', $request->get('pos_id'));
        }
        if ($request->filled('from_date')) {
            $revenues->where('created_at', '>=', $request->get('from_date'));
        }
        if ($request->filled('to_date')) {
            $revenues->where('created_at', '<=', $request->get('to_date'));
        }

        return $revenues;
    }
}
