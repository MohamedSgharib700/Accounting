<?php

namespace App\Exports;

use App\Models\Transaction;
// use App\Models\Pos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DateTransactionExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from_date,$to_date)
    {
       $this->from_date = $from_date;
       $this->to_date = $to_date;
    }

    public function collection()
      {
        return Transaction::select(['service_id','user_service_number','value','created_at' ,'fees','commissions'])->whereDate('created_at', '>=', $this->from_date)->whereDate('created_at', '<=', $this->to_date)->get();
      }

      public function headings(): array
       {
          return [
            'رقم الخدمة',
            'رقم الماكينة',
            'القيمة',
            'التاريخ',
            'الرسوم',
            'العمولة'
           ];
        }
}
