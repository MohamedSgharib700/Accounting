<?php

namespace App\Exports;

use App\Models\Pos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllAvailablePosExcelView  implements FromView
{

  public function view() : View
    {
        return view('admin.all-pos.available-pos-excel', [
            'pos' => Pos::where('customer_id', '=', null)->get(),
            'count' => Pos::where('customer_id', '=', null)->count()
        ]);
    }
  }
