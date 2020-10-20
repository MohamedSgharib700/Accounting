<?php

namespace App\Repositories;

use App\Models\PosNote;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class PosNoteRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $operations = PosNote::orderByDesc("id")
           ->when($request->get('old_agent'), function ($operations) use ($request) {
                return $operations->WhereHas('old_agent', function ($operations) use ($request){
                    $operations->where('name', 'like', '%' . $request->query->get('old_agent') . '%');
                });
            })->when($request->get('current_agent'), function ($operations) use ($request) {
                return $operations->WhereHas('current_agent', function ($operations) use ($request){
                    $operations->where('name', 'like', '%' . $request->query->get('current_agent') . '%');
                });
            })->when($request->get('serial'), function ($operations) use ($request) {
                return $operations->WhereHas('pos', function ($operations) use ($request){
                    $operations->where('serial', 'like', '%' . $request->query->get('serial') . '%');
                });
            })->when($request->get('from_date'), function ($operations) use ($request) {
                    $operations->whereDate('created_at', '>=', $request->query->get('from_date'))->whereDate('created_at', '<=', $request->query->get('to_date'));
            });
            
        return $operations;
    }

}
