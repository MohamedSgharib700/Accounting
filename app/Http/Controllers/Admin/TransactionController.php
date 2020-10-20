<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use App\Models\AgentBalance;
use App\Models\TransferCreditFromDelegateToCustomers;
use App\Repositories\OperationRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\TransactionFailedRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\agentRequest;
use Validator;
use View;
use Auth;
use Redirect,Response;
use App\Exports\AllTransactionExport;
use App\Exports\DateTransactionExport;
use App\Exports\TransactionsExcelView;
use App\Exports\TransactionsFailedExcelView;
use App\Exports\TransactionsDateExcelView;
use App\Exports\TransactionsFailedDateExcelView;
use App\Exports\DailyCommissionsExcelView;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\Commission;
use Illuminate\Support\Facades\DB;
use PDF;
class TransactionController extends Controller
{
    protected $userService;
    protected $userRepository;
    private $uploaderService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct( UploaderService $uploaderService,TransactionRepository $transactionRepository,TransactionFailedRepository $transactionFailedRepository)
    {
        //create read update delete permission for user

        $this->uploaderService = $uploaderService;
        $this->transactionRepository= $transactionRepository;
        $this->transactionFailedRepository= $transactionFailedRepository;
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(agentRequest $request)
    {

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function DateexportExcel(Request $request){
        $mytime = Carbon::now();
        
        if($request->query->get('from_date')){
            return  Excel::download(new DateTransactionExport($request->query->get('from_date'),$request->query->get('to_date')), 'AllTransactions-'.$mytime->toDateTimeString().'.xlsx');
        }else{
            return  Excel::download(new AllTransactionExport(), 'AllTransactions-'.$mytime->toDateTimeString().'.xlsx'); 
        }
         
    } 

    public function export(Request $request)
    {
        $mytime = Carbon::now();

        if($request->query->get('from_date')){
            return  Excel::download(new TransactionsDateExcelView($request->query->get('from_date'),$request->query->get('to_date'),$request->query->get('agent_name')), 'AllTransactions-'.$mytime->toDateTimeString().'.xlsx');
        }else{
            return Excel::download(new TransactionsExcelView,  'AllTransactions-'.$mytime->toDateTimeString().'.xlsx' );
        }


    }
    public function export_failed(Request $request)
    {
        $mytime = Carbon::now();

        if($request->query->get('from_date')){
            return  Excel::download(new TransactionsFailedDateExcelView($request->query->get('from_date'),$request->query->get('to_date'),$request->query->get('agent_name')), 'AllTransactionsFailed-'.$mytime->toDateTimeString().'.xlsx');
        }else{
            return Excel::download(new TransactionsFailedExcelView,  'AllTransactions-'.$mytime->toDateTimeString().'.xlsx' );
        }


    }

    public function show_balances($id)
    {
        $customer_balance=TransferCreditFromDelegateToCustomers::where('created_by', $id)->sum('money');
        $agent_balance=AgentBalance::where('agent_id', $id)->sum('balance');
        $my_balance=$agent_balance-$customer_balance;
        $balances = $this->AgentBalanceRepository->searchFormRequest(request())->where('agent_id', $id)->paginate(5);
        $balances->appends(request()->all());
        $customer_balances = $this->TransferCreditCustomerRepository->search(request())->where('created_by', $id)->paginate(5);
        $customer_balances->appends(request()->all());
        return view('admin.agents.show-balances')->with('balances',$balances)->with('customer_balances',$customer_balances)->with('my_balance',$my_balance);
    }

    public function show_transactions()
    {
        $transactions = $this->transactionRepository->search(request())->paginate(20);
        $transactions->appends(request()->all());
        $sum=$this->transactionRepository->search(request())->sum('value');
        $count=$this->transactionRepository->search(request())->count();
        $sum_momkn=$this->transactionRepository->search(request())->where('company_id','=',NULL)->orWhere('company_id','=','1')->sum('value');
        $count_momkn=$this->transactionRepository->search(request())->where('company_id','=',NULL)->orWhere('company_id','=','1')->count();
        $sum_aman=$this->transactionRepository->search(request())->where('company_id','=','2')->sum('value');
        $count_aman=$this->transactionRepository->search(request())->where('company_id','=','2')->count();
        return view('admin.transactions.show-transactions')->with('transactions',$transactions)->with('sum',$sum)->with('count',$count)->with('sum_momkn',$sum_momkn)->with('count_momkn',$count_momkn)->with('sum_aman',$sum_aman)->with('count_aman',$count_aman);
    }
    public function show_transactions_failed()
    {
        $transactions = $this->transactionFailedRepository->search(request())->paginate(20);
        $transactions->appends(request()->all());
        $sum=$this->transactionFailedRepository->search(request())->sum('value');
        $count=$this->transactionFailedRepository->search(request())->count();
        $sum_momkn=$this->transactionFailedRepository->search(request())->where('company_id','=',NULL)->orWhere('company_id','=','1')->sum('value');
        $count_momkn=$this->transactionFailedRepository->search(request())->where('company_id','=',NULL)->orWhere('company_id','=','1')->count();
        $sum_aman=$this->transactionFailedRepository->search(request())->where('company_id','=','2')->sum('value');
        $count_aman=$this->transactionFailedRepository->search(request())->where('company_id','=','2')->count();
        return view('admin.transactions.show-transactions-failed')->with('transactions',$transactions)->with('sum',$sum)->with('count',$count)->with('sum_momkn',$sum_momkn)->with('count_momkn',$count_momkn)->with('sum_aman',$sum_aman)->with('count_aman',$count_aman);
    }
    public function commission(Request $request){
        $date=DB::table('transactions')->join('services','services.id','=','transactions.service_id')
        ->whereDate('transactions.created_at', '=', Carbon::yesterday())
        ->where('transactions.service_id', '!=', '27')->where('transactions.service_id', '!=', '28')->where('transactions.service_id', '!=', '29')
            ->selectRaw('transactions.pos_id as pos_id,count(transactions.id) as count,sum(transactions.value)*0.0116 as sum')
            ->groupBy('transactions.pos_id')
            ->get();
        $current_time =Carbon::parse(Carbon::now());
        $current_date=$current_time->addHour(2);
        foreach ($date as $row){
            $commision=new Commission();
            $commision->pos_id=$row->pos_id;
            $commision->commission=$row->sum;
            $commision->date=$current_date;
            $commision->save();
        }
        return response()->json($date);
    }
   
    public function commission_index(){
        $commissions=Commission::whereDate('date', '=', Carbon::today())->paginate(20);
        $date=DB::table('transactions')->join('services','services.id','=','transactions.service_id')
        ->whereDate('transactions.created_at', '=', Carbon::yesterday())
        ->where('transactions.service_id', '!=', '27')->where('transactions.service_id', '!=', '28')->where('transactions.service_id', '!=', '29')
            ->selectRaw('transactions.pos_id as pos_id,count(transactions.id) as count,sum(transactions.value)*0.0116 as sum')
            ->groupBy('transactions.pos_id')
            ->get();
            $commission=0;
            foreach ($date as $row){
              
                $commission=$commission+$row->sum;
                
            }
            $sum_today=$commission;
        $sum=Commission::all()->sum('commission');
        $count=Commission::whereDate('date','=',Carbon::today())->count();
        return view('admin.commission.index')->with('commissions',$commissions)->with('sum',$sum)->with('count',$count)->with('sum_today',$sum_today);
    }
    public function export_daily_commissions()
    {
        $mytime = Carbon::now();
        return  Excel::download(new DailyCommissionsExcelView(), 'DailyCommissions-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_daily_commissions_pdf()
    {
        $mytime = Carbon::now();
        $commissions=Commission::whereDate('date', '=', Carbon::today())->get();
        $sum=Commission::all()->sum('commission');
        $pdf = PDF::loadView('admin.commission.pdf', ['commissions' => $commissions, 'sum' => $sum]);
        return $pdf->download('DailyCommissions' . $mytime->toDateTimeString() . '.pdf');
    }
    public function commission_report(){
        $sum=Commission::all()->sum('commission');
        return response()->json(['sum'=>$sum]);
    }


}
