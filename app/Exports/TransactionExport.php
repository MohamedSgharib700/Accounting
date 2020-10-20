<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\Pos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($device)
    {
       $this->device = $device;
       $this->pos = $pos = Pos::findOrfail($device);
      
    }

      public function view() : View
      {
          return view('admin.transactions.excelTransactionsForAgent', [
              'transactions' => Transaction::where('pos_id', $this->device)->get()
              
          ]);
      }

}
