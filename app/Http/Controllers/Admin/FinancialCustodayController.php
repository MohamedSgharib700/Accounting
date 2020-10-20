<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialCustoday;
use App\Models\User;
use App\Repositories\FinancialCustodayRepository;
use View;
use Auth;
use Redirect,Response;
use App\Exports\AllTransactionPosPaymentExport;
use App\Exports\DateTransactionPosPaymentExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class FinancialCustodayController extends Controller
{

    protected $financialCustodayRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct( FinancialCustodayRepository $financialCustodayRepository)
    {
   
        $this->financialCustodayRepository = $financialCustodayRepository;

    }

    public function index(Request $request , $id)
    { 
        $agent = User::findOrFail($id);
        $installments = $this->financialCustodayRepository->searchFormRequest(request())->where('agent_id' , $id )->paginate(20);
        $installments->appends(request()->all());

        $agent_pos_balance=FinancialCustoday::where('agent_id', $id)->sum('value');
        $agent_pos_balance_payed=FinancialCustoday::where('agent_id', $id)->where('status',1)->sum('value');
        $agent_pos_balance_unpayed=FinancialCustoday::where('agent_id', $id)->where('status',0)->sum('value');

        return view('admin.financialCustodays.index', ['installments' => $installments , 'agent' => $agent  , 'agent_pos_balance' => $agent_pos_balance, 'agent_pos_balance_payed' => $agent_pos_balance_payed, 'agent_pos_balance_unpayed' => $agent_pos_balance_unpayed ,'id' =>$id ]);

    }


    public function ExportExcel(Request $request , $id)
    {
        $mytime = Carbon::now();
        
        if($request->query->get('from_date')){
            return  Excel::download(new DateTransactionPosPaymentExport($request->query->get('from_date'),$request->query->get('to_date'),$id), 'AllTransactions-'.$mytime->toDateTimeString().'.xlsx');
        }else{
            return Excel::download(new AllTransactionPosPaymentExport($id), 'AllTransactions-'.$mytime->toDateTimeString().'.xlsx' ); 
        }
        
       
    }
    public function change_status($id)
    {
        $operation = FinancialCustoday::find($id);
        $operation->status = 1;
        $current_time =Carbon::now();
        $operation->payment_date = $current_time->toDateTimeString();
        $operation->save();
        return response()->json($operation);
    }
}
