<?php

namespace App\Exports;

use App\Models\Transaction;
// use App\Models\Pos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsExcelView implements FromView
{
  public function view() : View
    {
        return view('admin.transactions.excelTransaction', [
            'transactions' => Transaction::all()
        ]);
    }
  }
