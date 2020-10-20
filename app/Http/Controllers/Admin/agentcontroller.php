<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use App\Models\User;
use App\Models\AgentBalance;
use App\Models\SendFromDelegateToBanks;
use App\Models\TransferCreditFromDelegateToCustomers;
use App\Models\RefundMoneyFromClientToDelegates;
use App\Http\Services\AgentWebService;
use App\Repositories\UserRepository;
use App\Repositories\TransferToBankRepository;
use App\Repositories\PosRepository;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\agentRequest;
use App\Exports\AgentsBalancesExport; 
use App\Exports\AgentsTransfersToBank; 
use Validator;
use View;
use Auth;
use Redirect,Response;
use Carbon\Carbon;
use PDF;
use App\Exports\AllAgentsMoneyDateExcelView;
use App\Exports\AllAgentsCustomerMoneyDateExcelView;
use App\Exports\AllCustomerAgentsMoneyDateExcelView;
use App\Exports\AllAgentsBalancesDateExcelView;
use Maatwebsite\Excel\Facades\Excel;


class agentcontroller extends Controller
{
    protected $userService;
    protected $userRepository;
    protected $transferToBankRepository;
    private $uploaderService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(AgentWebService $userService, UserRepository $userRepository, TransferToBankRepository $transferToBankRepository, UploaderService $uploaderService)
    {
        //create read update delete permission for user

        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->transferToBankRepository = $transferToBankRepository;
        $this->uploaderService = $uploaderService;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->search(request())->where('type',5)->paginate(20);
        $users->appends(request()->all());
        $agent_balance=AgentBalance::where('type',1)->sum('balance');
        $bank_balance=SendFromDelegateToBanks::sum('value');
        $discountsForAgent =AgentBalance::where('type' , 0)->sum('balance');
        $discountsfinally = $discountsForAgent * -1 ;
        $customer_balance=TransferCreditFromDelegateToCustomers::sum('money');
        $customer_delegate_balance=RefundMoneyFromClientToDelegates::sum('value');
        $allagentsCurrentBallance=$agent_balance - $customer_balance +$discountsForAgent +$customer_delegate_balance ;
        $allCustomersCurrentBallance=$agent_balance + $discountsForAgent-$bank_balance;
        return view('admin.agents.index', ['users' => $users ,'agent_balance' => $agent_balance ,'allagentsCurrentBallance' => $allagentsCurrentBallance ,'allCustomersCurrentBallance' => $allCustomersCurrentBallance]);
    }
    public function track_agent_balance($date)
    {
        $users = $this->userRepository->search(request())->where('type',5)->paginate(20);
        $users->appends(request()->all());
        $agent_balance=AgentBalance::where('type',1)->whereDate('created_at','<=',$date)->sum('balance');
        $bank_balance=SendFromDelegateToBanks::whereDate('created_at','<=',$date)->sum('value');
        $discountsForAgent =AgentBalance::where('type' , 0)->whereDate('created_at','<=',$date)->sum('balance');
        $discountsfinally = $discountsForAgent * -1 ;
        $customer_balance=TransferCreditFromDelegateToCustomers::whereDate('created_at','<=',$date)->sum('money');
        $customer_delegate_balance=RefundMoneyFromClientToDelegates::whereDate('created_at','<=',$date)->sum('value');
        $allagentsCurrentBallance=$agent_balance - $customer_balance +$discountsForAgent +$customer_delegate_balance ;
        $allCustomersCurrentBallance=$agent_balance + $discountsForAgent-$bank_balance;
        return view('admin.agents.agent-balances-track', ['users' => $users ,'agent_balance' => $agent_balance ,'allagentsCurrentBallance' => $allagentsCurrentBallance ,'allCustomersCurrentBallance' => $allCustomersCurrentBallance,'date'=>$date]);

    }
   public function transferToBank(Request $request)
   {
       $transfers = $this->transferToBankRepository->search(request())->paginate(20);
       $transfers->appends(request()->all());
       $transferTotal=$this->transferToBankRepository->search(request())->sum('value');
       $transferCount=$this->transferToBankRepository->search(request())->count();
       return view('admin.agents.transferToBank', ['transfers' => $transfers , 'transferTotal' => $transferTotal , 'transferCount' => $transferCount]);
   }

   public function EditAllCustomerscode(Request $request)
   {
    $users = $this->userRepository->search(request())->where('type',5)->paginate(20);
    $users->appends(request()->all());

    return view('admin.userCodes.index', ['users' => $users]);
   }

   public function edit(User $user)
   {
       return View::make('admin.userCodes.edit', ['user' => $user]);
   }

   public function update(Request $request, User $user)
   {
       $this->userService->fillFromRequest($request, $user);
       return redirect(route('userCodes'))->with('message', trans('تم اضافة الكود بنجاح'));

   }
   public function exportTotalAllagentsPdf(){
    $users = $this->userRepository->search(request())->where('type',5)->get();
    $agent_balance=AgentBalance::where('type',1)->sum('balance');
    $bank_balance=SendFromDelegateToBanks::sum('value');
    $discountsForAgent =AgentBalance::where('type' , 0)->sum('balance');
    $customer_balance=TransferCreditFromDelegateToCustomers::sum('money');
        $customer_delegate_balance=RefundMoneyFromClientToDelegates::sum('value');
        $allagentsCurrentBallance=$agent_balance - $customer_balance +$discountsForAgent +$customer_delegate_balance ;
    $allCustomersCurrentBallance=$agent_balance - $bank_balance + $discountsForAgent;   
        
    $pdf = PDF::loadView('admin.agents.AllagentsTotals_pdf_form' ,['users' => $users ,'agent_balance' => $agent_balance ,'allagentsCurrentBallance' => $allagentsCurrentBallance ,'allCustomersCurrentBallance' => $allCustomersCurrentBallance]);

    return $pdf->download('allagents.pdf'); 
} 

public function export(Request $request)
    {
            $mytime = Carbon::now();
            return  Excel::download(new AllAgentsMoneyDateExcelView($request->query->get('from_date'),$request->query->get('to_date')), 'AllAgentsBalances-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_customer_to_delegate(Request $request)
    {
        $mytime = Carbon::now();
        return  Excel::download(new AllCustomerAgentsMoneyDateExcelView($request->query->get('from_date'),$request->query->get('to_date')), 'AllCustomerAgentsBalances-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_delegate_to_customer(Request $request)
    {
        $mytime = Carbon::now();
        return  Excel::download(new AllAgentsCustomerMoneyDateExcelView($request->query->get('from_date'),$request->query->get('to_date')), 'AllAgentsCustomerBalances-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_pdf(Request $request)
    {
        $mytime = Carbon::now();
        $balances= AgentBalance::whereDate('created_at', '>=',$request->query->get('from_date'))->whereDate('created_at', '<=',$request->query->get('to_date'))->get();
        $sum=AgentBalance::whereDate('created_at', '>=',$request->query->get('from_date'))->whereDate('created_at', '<=',$request->query->get('to_date'))->sum('balance');
        $pdf = PDF::loadView('admin.all-agents-balances-report.total-balances-pdf', ['balances'=>$balances,'sum'=>$sum,
            'my_time'=>$mytime->toDateString()]);
        return $pdf->download('all-agent-balances'.$mytime->toDateTimeString().'.pdf');
    }

    public function agentsPosStored(Request $request)
{
    $users = $this->userRepository->search(request())->where('type',5)->paginate(20);
    $users->appends(request()->all());

    return view('admin.agents.agentStores', ['users' => $users ]);

}

public function AgentsExportExcel(){

    return Excel::download(new AgentsBalancesExport, 'agents_Balances.xlsx'); 
} 

public function transfersToBankExportExcel(){

    return Excel::download(new AgentsTransfersToBank, 'transfers_to_bank.xlsx'); 
} 
public function AgentsExportDateExcel($date){

    return Excel::download(new AllAgentsBalancesDateExcelView($date), 'agents_Balances_'.$date.'.xlsx');
}

public function edit_bank_transfer(Request $request,$id)
{
    $operation = SendFromDelegateToBanks::find($id);
    $operation->value = $request->input('value');
    $operation->save();
    $operation->load('user');
    return response()->json($operation);
}
public function refund(Request $request,$pos_id,$delegate_id,$client_id,$current)
{
    $validator = Validator::make($request->all(),
        [
            'value' => 'required|numeric',
          
        ],
        [
            'value.required' => trans('يجب ان تدخل القيمه '),
        
            
        ]
    );
    if ($validator->fails()) {
        return response()->json(
            array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray())
            , 400);
    } else {
        if($current>=$request->input('value')){
            $refund = new RefundMoneyFromClientToDelegates();
        $refund->delegate_id = $delegate_id;
        $refund->pos_id = $pos_id;
        $refund->client_id = $client_id;
        $refund->created_by = Auth::user()->id;
        $refund->done_from_id = Auth::user()->id;
        $current_time =Carbon::parse(Carbon::now());
        $current_date=$current_time->addHour(2);
        $refund->created_date=$current_date;
        $refund->done_date=$current_date;
        $refund->created_at=$current_date;
        $refund->value= $request->input('value');
        $refund->status= 1;
        $refund->save();
        return response()->json($refund);
        }else{
            $refund=["message"=>"لا يوجد رصيد كافي للسحب"];
            return response()->json($refund);
        }
        
    }
}


}
