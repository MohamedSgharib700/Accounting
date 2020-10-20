<?php

namespace App\Repositories;

use App\Models\Pos;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class PosRepository
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
            });
        if ($request->filled('active')) {
            $operations->where('active', $request->query->get('active'));
        }

        return $operations;
    }

}