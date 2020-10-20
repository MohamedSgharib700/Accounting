<?php

namespace App\Exports;

use App\Models\FinancialCustoday;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DateTransactionPosPaymentExport  implements FromView
{
   public function __construct($from_date,$to_date,$id)
    {
       $this->from_date = $from_date;
       $this->to_date = $to_date;
       $this->id = $id;
    }
  public function view() : View
    {
        return view('admin.financialCustodays.excelTransaction', [
            'installments' => FinancialCustoday::where('agent_id', '=', $this->id)->whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date)->get()
        ]);
    }
  }
