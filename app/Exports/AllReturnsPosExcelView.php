<?php

namespace App\Exports;

use App\Models\Pos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllReturnsPosExcelView  implements FromView
{
  public function __construct($from_date,$to_date)
  {
     $this->from_date = $from_date;
     $this->to_date = $to_date;
  }
  public function view() : View
    {
        return view('admin.all-pos.returns-pos-excel', [
            'pos' => Pos::where('user_id','=' ,0)
            ->whereDate('updated_at', '>=', $this->from_date)->whereDate('updated_at', '<=', $this->to_date) 
            ->get(),
        ]);
    }
  }
