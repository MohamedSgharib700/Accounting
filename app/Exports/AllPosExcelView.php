<?php

namespace App\Exports;

use App\Models\Pos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllPosExcelView  implements FromView
{
   public function __construct($id)
    {
       $this->id = $id;
    }
  public function view() : View
    {
        return view('admin.agents-pos.all-pos-excel', [
            'pos' => Pos::where('user_id', '=', $this->id)->get(),
            'count' => Pos::where('user_id', '=', $this->id)->count()
        ]);
    }
  }
