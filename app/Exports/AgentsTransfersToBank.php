<?php

namespace App\Exports;

use App\Models\SendFromDelegateToBanks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AgentsTransfersToBank implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct()
    {
      
    }

      public function view() : View
      {
          return view('admin.agents.agentsTransferTobankExcel', [
              'transfers' => SendFromDelegateToBanks::all()
              
          ]);
      }

}
