<?php

namespace App\Exports;

use App\Models\TransactionField;
// use App\Models\Pos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsFailedExcelView implements FromView
{
  public function view() : View
    {
        return view('admin.transactions.excelTransactionFailed', [
            'transactions' => TransactionField::all()
        ]);
    }
  }
