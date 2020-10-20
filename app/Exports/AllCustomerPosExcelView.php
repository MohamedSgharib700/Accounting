<?php

namespace App\Exports;

use App\Models\Pos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllCustomerPosExcelView  implements FromView
{
  public function __construct($from_date,$to_date)
  {
     $this->from_date = $from_date;
     $this->to_date = $to_date;
  }
  public function view() : View
    {
        return view('admin.all-pos.customer-pos-excel', [
            'pos' => Pos::where('customer_id', '>', 0)->where('user_id','>' ,0)
            ->whereHas('customer', function($q){
                  $q->whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date);
              
          })->get(),
        ]);
    }
  }
