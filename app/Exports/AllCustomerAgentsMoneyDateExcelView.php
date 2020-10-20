<?php

namespace App\Exports;

use App\Models\RefundMoneyFromClientToDelegates;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllCustomerAgentsMoneyDateExcelView  implements FromView
{
   public function __construct($from_date,$to_date)
    {
       $this->from_date = $from_date;
        $this->to_date = $to_date;
    }
  public function view() : View
    {
        return view('admin.all-agents-balances-report.customer-refund-excel', [
            'balances' => RefundMoneyFromClientToDelegates::whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date)->get(),
            'sum' => RefundMoneyFromClientToDelegates::whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date)->sum('value')
        ]);
    }
  }
