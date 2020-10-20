<?php

namespace App\Exports;

use App\Models\TransferCreditFromDelegateToCustomers;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllAgentsCustomerMoneyDateExcelView  implements FromView
{
   public function __construct($from_date,$to_date)
    {
       $this->from_date = $from_date;
        $this->to_date = $to_date;
    }
  public function view() : View
    {
        return view('admin.all-agents-balances-report.delegate-customer-refund-excel', [
            'balances' => TransferCreditFromDelegateToCustomers::whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date)->get(),
            'sum' => TransferCreditFromDelegateToCustomers::whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date)->sum('money')
        ]);
    }
  }
