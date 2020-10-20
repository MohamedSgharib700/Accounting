<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllAgentsBalancesDateExcelView  implements FromView
{
   public function __construct($date)
    {
       $this->date = $date;
    }
    public function view() : View
    {
        return view('admin.agents.all-agents-balances-date-excel', [
            'agents' => User::where('type', 5)->get()

        ])->with('date',$this->date);
    }
  }
