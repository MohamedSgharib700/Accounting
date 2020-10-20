<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use App\Models\User;
use App\Models\Area;
use App\Models\TransferCreditFromDelegateToCustomers;
use App\Models\SendFromDelegateToBanks;
use App\Models\AgentBalance;
use App\Models\Expense;
use App\Models\RefundMoneyFromClientToDelegates;
use App\Http\Services\BalanceService;
use App\Repositories\AgentBalanceRepository;
use App\Repositories\TransferCreditCustomerRepository;
use App\Repositories\RefundMoneyFromClientToDelegatesRepository;
use App\Repositories\CompanyRevenuesRepository;
use App\Repositories\BankBalanceRepository;
use App\Repositories\AreaRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\Admin\BalanceRequest;
use App\Exports\BalanceExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Http\Request;
use View;

class BalanceController extends Controller
{
    protected $balanceService;
    protected $balanceRepository;
    protected $areaRepository;
    protected $userRepository;
    protected $BankBalanceRepository;
    protected $CompanyRevenuesRepository;
    private   $uploaderService;


    public function __construct(CompanyRevenuesRepository $CompanyRevenuesRepository , BalanceService $balanceService , AgentBalanceRepository $balanceRepository, AreaRepository $areaRepository, UserRepository $userRepository, UploaderService $uploaderService ,BankBalanceRepository $BankBalanceRepository ,TransferCreditCustomerRepository $TransferCreditCustomerRepository,RefundMoneyFromClientToDelegatesRepository $RefundMoneyFromClientToDelegates)
    {
        $this->balanceService = $balanceService;
        $this->balanceRepository = $balanceRepository;
        $this->areaRepository = $areaRepository ;
        $this->userRepository = $userRepository;
        $this->BankBalanceRepository = $BankBalanceRepository;
        $this->uploaderService = $uploaderService;
        $this->TransferCreditCustomerRepository= $TransferCreditCustomerRepository;
        $this->RefundMoneyFromClientToDelegates= $RefundMoneyFromClientToDelegates;
        $this->CompanyRevenuesRepository= $CompanyRevenuesRepository;
    }

    public function index(Request $request)
    {
        $users = $this->balanceRepository->searchFormRequest(request())->where('type' , 1)->paginate(20);
        $users->appends(request()->all());
        $agents = $this->userRepository->search(request())->get();
        $agents_only=User::where('type','=',5)->get();
        return View::make('admin.balances.index', ['users' => $users , 'agents' => $agents, 'agents_only' => $agents_only]);
    }

    public function create()
    {
        $agents=User::where('type',5)->get();
        $areas=Area::all();
        return View::make('admin.balances.create',compact('agents','areas'));
    }

    public function store(BalanceRequest $request)
    {
         if($balance = $this->balanceService->fillFromRequest($request)){
            // $balance->$request->type = 1 ;
        return redirect(route('balances.index'))->with('message', trans('تم اضافه الرصيد بنجاح'));
    }else{
        return redirect(route('balances.create'))->with('message', trans('عفوا الرصيد الحالي لا يسمح لاتمام عملية الدفع'));
    }
    }

    // public function showRecharges(Pos $device)
    // {
    //     return View::make('admin.balances.show_recharges' ,['device' => $device]);
    // }

    public function exportExcel($device){
        return Excel::download(new BalanceExport($device), 'balances.xlsx');
    }

    public function exportPdf(Pos $device){

        $pdf = PDF::loadview('admin.balances.pdf_form' ,['device' => $device]);
        return $pdf->download('balances.pdf');
    }

    public function show_agent($id)
    {
        $users = $this->balanceRepository->searchFormRequest(request())->where('agent_id', $id)->where('type',1)->paginate(20);
        $users->appends(request()->all());
        $agents = $this->userRepository->search(request())->get();
        $agents_only=User::where('type','=',5)->get();
        return view('admin.balances.index', ['users' => $users , 'agents' => $agents, 'agents_only' => $agents_only]);
    }

    public function show_balances($id)
    {
        $agent = User::findOrFail($id);
        $customer_balance=TransferCreditFromDelegateToCustomers::where('created_by', $id)->sum('money');
        $customer_delegate_balance=RefundMoneyFromClientToDelegates::where('delegate_id', $id)->sum('value');
        $bank_balance=SendFromDelegateToBanks::where('created_by', $id)->sum('value');
        $agent_balance=AgentBalance::where('agent_id', $id)->where('type',1)->sum('balance');
        $discountsForAgent =AgentBalance::where('agent_id', $id)->where('type' , 0)->sum('balance');
        $agent_expenses_balances =Expense::where('user_id', $id)->sum('value');
        $discountsfinally = $discountsForAgent * -1 ;
        $discounts = $this->balanceRepository->searchFormRequest(request())->where('agent_id', $id)->where('type' , 0)->paginate(10);
        $discounts->appends(request()->all());
        $my_balance = $agent_balance-$bank_balance - $discountsfinally - $customer_balance;
        $availableBalance = $agent_balance - $customer_balance +$discountsForAgent +$customer_delegate_balance ;
        $requiredBalance = $agent_balance - $discountsfinally  - $bank_balance ;
        $balances = $this->balanceRepository->searchFormRequest(request())->where('agent_id', $id)->where('type',1)->paginate(5);
        $balances->appends(request()->all());
        $bank_balances = $this->BankBalanceRepository->search(request())->where('created_by', $id)->paginate(5);
        $bank_balances->appends(request()->all());
        $customer_balances = $this->TransferCreditCustomerRepository->search(request())->where('created_by', $id)->paginate(5);
        $customer_balances->appends(request()->all());
        $customer_delegate_balances = $this->RefundMoneyFromClientToDelegates->search(request())->where('delegate_id', $id)->paginate(5);
        $customer_delegate_balances->appends(request()->all());
        //agents revenues
        $revenues = $this->CompanyRevenuesRepository->search(request())->where('agent_id', $id)->paginate(5);
        $revenues->appends(request()->all());

        return view('admin.agents.show-balances',['agent_expenses_balances' => $agent_expenses_balances ,'customer_delegate_balance' => $customer_delegate_balance ,'bank_balance' => $bank_balance ,'customer_balance' => $customer_balance ,'customer_delegate_balances' => $customer_delegate_balances,'agent_balance' => $agent_balance ,'revenues' => $revenues ,'discounts' => $discounts , 'discountsForAgent' => $discountsForAgent, 'customer_balances' => $customer_balances , 'agent' => $agent , 'availableBalance' => $availableBalance , 'requiredBalance' => $requiredBalance])->with('balances',$balances)->with('bank_balances',$bank_balances)->with('my_balance',$my_balance);
    }


    public function exportPdfBalance($id){
        $agent = User::findOrFail($id);
        $customer_balance=TransferCreditFromDelegateToCustomers::where('created_by', $id)->sum('money');
        $bank_balance=SendFromDelegateToBanks::where('created_by', $id)->sum('value');
        $agent_balance=AgentBalance::where('agent_id', $id)->where('type',1)->sum('balance');
        $discountsForAgent =AgentBalance::where('agent_id', $id)->where('type' , 0)->sum('balance');
        $agent_expenses_balances =Expense::where('user_id', $id)->sum('value');
        $discountsfinally = $discountsForAgent * -1 ;
        $discounts = $this->balanceRepository->searchFormRequest(request())->where('agent_id', $id)->where('type' , 0)->get();
        $customer_delegate_balance=RefundMoneyFromClientToDelegates::where('delegate_id', $id)->sum('value');
        $my_balance = $agent_balance-$bank_balance - $discountsfinally - $customer_balance;
        $availableBalance = $agent_balance - $customer_balance +$discountsForAgent +$customer_delegate_balance ;
        $requiredBalance = $agent_balance - $discountsfinally  - $bank_balance ;
        $balances = $this->balanceRepository->searchFormRequest(request())->where('agent_id', $id)->where('type',1)->get();
        $bank_balances = $this->BankBalanceRepository->search(request())->where('created_by', $id)->get();
        $customer_balances = $this->TransferCreditCustomerRepository->search(request())->where('created_by', $id)->get();

        $customer_delegate_balances = RefundMoneyFromClientToDelegates::where('delegate_id', $id)->get();
        $revenues = $this->CompanyRevenuesRepository->search(request())->where('agent_id', $id)->get();
        $pdf = PDF::loadview('admin.agents.show_balances_pdf' ,['bank_balance' => $bank_balance ,'customer_delegate_balance' => $customer_delegate_balance ,'customer_delegate_balances' => $customer_delegate_balances,'customer_balance' => $customer_balance ,'agent_balance' => $agent_balance ,'agent_expenses_balances' => $agent_expenses_balances ,'revenues' => $revenues , 'discounts' => $discounts , 'discountsForAgent' => $discountsForAgent, 'customer_balances' => $customer_balances , 'agent' => $agent , 'availableBalance' => $availableBalance , 'requiredBalance' => $requiredBalance , 'balances' => $balances , 'my_balance' => $my_balance , 'bank_balances' => $bank_balances]);
        return $pdf->download('agent_report.pdf');
    }

    public function indexBalancesDiscount(Request $request)
    {
        $users = $this->balanceRepository->searchFormRequest(request())->where('type' , 0)->paginate(20);
        $users->appends(request()->all());
        $agents = $this->userRepository->search(request())->get();
        $agents_only=User::where('type','=',5)->get();
        return View::make('admin.balances.indexBalancesDiscount', ['users' => $users , 'agents' => $agents, 'agents_only' => $agents_only]);
    }

    public function ShowBalancesDiscount()
    {
        $agents=User::where('type',5)->get();
        $areas=Area::all();
        return View::make('admin.balances.discount',compact('agents','areas'));
    }

    public function balancesDiscount(BalanceRequest $request)
    {
         if($balance = $this->balanceService->fillFromRequestDiscount($request)){
        return redirect(route('balances.discount'))->with('message', trans('تم خصم الرصيد بنجاح'));
    }else{
        return redirect(route('show.balance.discount'))->with('message', trans('عفوا الرصيد الحالي لا يسمح لاتمام عملية الدفع'));
    }
    }

}
