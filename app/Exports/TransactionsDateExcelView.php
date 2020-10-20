<?php

namespace App\Exports;

use App\Models\Transaction;
// use App\Models\Pos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsDateExcelView  implements FromView
{
   public function __construct($from_date,$to_date,$agent_name)
    {
       $this->from_date = $from_date;
       $this->to_date = $to_date;
        $this->agent_name = $agent_name;
    }
  public function view() : View
    {
        return view('admin.transactions.excelTransaction', [
            'transactions' => Transaction::whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date)
                            ->whereHas('pos', function($q){
                                $q->whereHas('user', function($q){
                                    $q->where('name', 'like', '%' . $this->agent_name . '%' );
                                });
                            })->get()
        ]);
    }
}
