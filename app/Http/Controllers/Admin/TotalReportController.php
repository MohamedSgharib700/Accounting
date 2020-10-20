<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AmwalBalanceService;
use App\Models\AgentBalance;
use App\Models\AmwalBalance;
use App\Models\CompanyRevenue;
use App\Models\Expense;
use App\Models\Pos;
use App\Models\SendFromDelegateToBanks;
use App\Models\Transaction;
use App\Models\TransferCreditFromDelegateToCustomers;
use App\Repositories\AmwalBalanceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PDF;
use View;
use Auth;
use Response;

class TotalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(AmwalBalanceService $balanceService , AmwalBalanceRepository $balanceRepository)
    {
        $this->balanceService = $balanceService;
        $this->balanceRepository = $balanceRepository;
    }

    public function index()
    {
        $amwal_balances=AmwalBalance::sum('balance');
        $total_transactions=Transaction::sum('value');
        $agent_balances=AgentBalance::where('type',1)->sum('balance');
        $agent_discount_balances=AgentBalance::where('type',0)->sum('balance')*-1;
        $pos_balances=TransferCreditFromDelegateToCustomers::sum('money');
        $bank_balances=SendFromDelegateToBanks::sum('value');
        $all_agent_balances=AgentBalance::sum('balance');
        $revenues=CompanyRevenue::sum('value');
        $expenses=Expense::sum('value');
        $Treasure=$revenues-$expenses;
        $order_agent_balances=$all_agent_balances-$bank_balances;
        $available_agent_balances=$amwal_balances-$all_agent_balances;
        return view('admin.total-report.index')->with('total_transactions',$total_transactions)
            ->with('agent_balances',$agent_balances)
            ->with('pos_balances',$pos_balances)
            ->with('bank_balances',$bank_balances)
            ->with('order_agent_balances',$order_agent_balances)
            ->with('available_agent_balances',$available_agent_balances)
            ->with('agent_discount_balances',$agent_discount_balances)
            ->with('Treasure',$Treasure);

    }
    public function export_pdf(Request $request)
    {
        $mytime = Carbon::now();
        $amwal_balances=AmwalBalance::sum('balance');
        $total_transactions=Transaction::sum('value');
        $agent_balances=AgentBalance::where('type',1)->sum('balance');
        $agent_discount_balances=AgentBalance::where('type',0)->sum('balance')*-1;
        $pos_balances=TransferCreditFromDelegateToCustomers::sum('money');
        $bank_balances=SendFromDelegateToBanks::sum('value');
        $all_agent_balances=AgentBalance::sum('balance');
        $revenues=CompanyRevenue::sum('value');
        $expenses=Expense::sum('value');
        $Treasure=$revenues-$expenses;
        $order_agent_balances=$all_agent_balances-$bank_balances;
        $available_agent_balances=$amwal_balances-$all_agent_balances;
        $AmwalBalances = AmwalBalance::all();
        $sum=$this->balanceRepository->searchFormRequest(request())->sum('balance');
        $pdf = PDF::loadView('admin.total-report.pdf', ['total_transactions'=>$total_transactions,
            'agent_balances'=>$agent_balances,
            'pos_balances'=>$pos_balances,
            'bank_balances'=>$bank_balances,
            'order_agent_balances'=>$order_agent_balances,
            'available_agent_balances'=>$available_agent_balances,
            'agent_discount_balances'=>$agent_discount_balances,
            'Treasure'=>$Treasure,
            'AmwalBalances'=>$AmwalBalances,
            'amwal_balances'=>$amwal_balances,
            'my_time'=>$mytime->toDateString()]);
        return $pdf->download('total'.$mytime->toDateTimeString().'.pdf');
    }
    public function export_total_pdf(Request $request)
    {
        $mytime = Carbon::now();
        $amwal_balances=AmwalBalance::sum('balance');
        $total_transactions=Transaction::sum('value');
        $agent_balances=AgentBalance::where('type',1)->sum('balance');
        $agent_discount_balances=AgentBalance::where('type',0)->sum('balance')*-1;
        $pos_balances=TransferCreditFromDelegateToCustomers::sum('money');
        $bank_balances=SendFromDelegateToBanks::sum('value');
        $all_agent_balances=AgentBalance::sum('balance');
        $revenues=CompanyRevenue::sum('value');
        $expenses=Expense::sum('value');
        $Treasure=$revenues-$expenses;
        $order_agent_balances=$all_agent_balances-$bank_balances;
        $available_agent_balances=$amwal_balances-$all_agent_balances;
        $AmwalBalances = AmwalBalance::all();
        $all_pos=Pos::all()->count();
        $agent_pos=Pos::where('user_id','>',0)->count();
        $remain_pos=$all_pos-$agent_pos;
        $data = Http::get("http://www.momkn.org:9090/MomknServices/api/CentersBalance?UserName=7BMC17&Password=9317076&CenId=42621")->json();
        $wallet = $data['balance'];
        $amwal_balance=AmwalBalance::selectRaw('company_id,sum(balance) as sum')->groupBy('company_id')->get();
        $pdf = PDF::loadView('admin.total-report.total-pdf', ['total_transactions'=>$total_transactions,
            'agent_balances'=>$agent_balances,
            'pos_balances'=>$pos_balances,
            'bank_balances'=>$bank_balances,
            'order_agent_balances'=>$order_agent_balances,
            'available_agent_balances'=>$available_agent_balances,
            'agent_discount_balances'=>$agent_discount_balances,
            'Treasure'=>$Treasure,
            'AmwalBalances'=>$AmwalBalances,
            'amwal_balances'=>$amwal_balances,
            'all_agent_balances'=>$all_agent_balances,
            'all_pos'=>$all_pos,
            'agent_pos'=>$agent_pos,
            'remain_pos'=>$remain_pos,
            'wallet'=>$wallet,
            'amwal_balance'=>$amwal_balance,
            'my_time'=>$mytime->toDateString()]);
        return $pdf->download('total'.$mytime->toDateTimeString().'.pdf');
    }


}