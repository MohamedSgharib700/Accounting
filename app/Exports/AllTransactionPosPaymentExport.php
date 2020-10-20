<?php

namespace App\Exports;

use App\Models\FinancialCustoday;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllTransactionPosPaymentExport implements FromView
{

  public function __construct($id)
  {
     $this->id = $id;
  }
  public function view() : View
    {
        return view('admin.financialCustodays.excelTransaction', [
            'installments' => FinancialCustoday::where('agent_id', '=', $this->id)->get()
        ]);
    }
  }
