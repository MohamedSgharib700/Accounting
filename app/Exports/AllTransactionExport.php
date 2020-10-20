<?php

namespace App\Exports;

use App\Models\Transaction;
// use App\Models\Pos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllTransactionExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function __construct($device)
    // {
    //    $this->device = $device;
    // }

    public function collection()
      {
        return Transaction::select(['user_service_number','value','created_at' ,'fees','commissions'])->get();
      }

      public function headings(): array
       {
          return [
            'رقم الماكينة',
            'القيمة',
            'التاريخ',
            'الرسوم',
            'العمولة'
           ];
        }
}
