<?php

namespace App\Exports;

use App\Models\Commission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DailyCommissionsExcelView implements FromView
{
  public function view() : View
    {
        return view('admin.commission.excel', [
            'commissions' => Commission::all()
        ]);
    }
  }
