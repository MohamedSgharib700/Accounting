<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AllPosExcelView;
use App\Exports\AvailablePosExcelView;
use App\Exports\CustomerPosExcelView;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use App\Models\User;
use App\Http\Services\AgentWebService;
use Illuminate\Http\Request;
use App\Repositories\BankBalanceRepository;
use App\Repositories\OperationRepository;
use App\Repositories\PosNoteRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\TransferCreditCustomerRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AllAvailablePosExcelView;
use App\Exports\AllCustomerPosExcelView;
use App\Exports\AllReturnsPosExcelView ;
use App\Exports\AllTwoAgentsPosExcelView ;
use App\Models\Pos;
use App\Models\PosNote;
use Validator;
use View;
use Auth;
use Redirect,Response;
use PDF;

class AgentPosController extends Controller
{
    protected $userService;
    protected $userRepository;
    private $uploaderService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(AgentWebService $userService, UserRepository $userRepository, UploaderService $uploaderService,OperationRepository $operationRepository,TransactionRepository $transactionRepository,PosNoteRepository $PosNoteRepository)
    {
        //create read update delete permission for user

        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->uploaderService = $uploaderService;
        $this->operationRepository= $operationRepository;
        $this->PosNoteRepository= $PosNoteRepository;
        $this->transactionRepository= $transactionRepository;
    }

    public function index()
    {
        $users = $this->userRepository->search(request())->where('type' , 5)->paginate(20);
        $users->appends(request()->all());
        return view('admin.agents-pos.index')->with('users',$users);

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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
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
    public function show_pos($id)
    {
        $pos = $this->operationRepository->search(request())->where('user_id', $id)->paginate(20);
        $pos->appends(request()->all());
        $count=$this->operationRepository->search(request())->where('user_id', $id)->count();
        return view('admin.agents-pos.show-pos')->with('pos',$pos)->with('count',$count)->with('id',$id);
    }
    public function pos_customer($id)
    {
        $pos = $this->operationRepository->search(request())->where('user_id', $id)->where('customer_id','>' ,0)->paginate(20);
        $pos->appends(request()->all());
        $count=$this->operationRepository->search(request())->where('user_id', $id)->where('customer_id','>' ,0)->count();
        return view('admin.agents-pos.show-pos-customer')->with('pos',$pos)->with('count',$count)->with('id',$id);
    }
    public function pos_available($id)
    {
        $pos = $this->operationRepository->search(request())->where('user_id', $id)->where('customer_id','=' ,null)->orWhere('customer_id','=',0)->paginate(20);
        $pos->appends(request()->all());
        $count=$this->operationRepository->search(request())->where('user_id', $id)->where('customer_id','=' ,null)->orWhere('customer_id','=',0)->count();
        return view('admin.agents-pos.show-pos-available')->with('pos',$pos)->with('count',$count)->with('id',$id);
    }
    public function export($id)
    {
        $mytime = Carbon::now();
        return  Excel::download(new AllPosExcelView($id), 'AllAgentPos-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_available_pos($id)
    {
        $mytime = Carbon::now();
        return  Excel::download(new AvailablePosExcelView($id), 'AvailableAgentPos-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_customer_pos($id)
    {
        $mytime = Carbon::now();
        return  Excel::download(new CustomerPosExcelView($id), 'CustomerAgentPos-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function all_pos_available()
    {
        $pos = $this->operationRepository->search(request())->where('customer_id','=' ,null)->paginate(20);
        $pos->appends(request()->all());
        $count=$this->operationRepository->search(request())->where('customer_id','=' ,null)->count();
        return view('admin.all-pos.all-pos-available')->with('pos',$pos)->with('count',$count);
    }
    public function all_pos_customer()
    {
        $pos = $this->operationRepository->search(request())->where('user_id','>' ,0)->where('customer_id','>' ,0)->paginate(20);
        $pos->appends(request()->all());
        $count=$this->operationRepository->search(request())->where('user_id','>' ,0)->where('customer_id','>' ,0)->count();
        return view('admin.all-pos.all-pos-customer')->with('pos',$pos)->with('count',$count);
    }
    public function all_pos_returns()
    {
        $pos = $this->operationRepository->search(request())->where('user_id','=' ,0)->paginate(20);
        $pos->appends(request()->all());
        $count=$this->operationRepository->search(request())->where('user_id','=' ,0)->count();
        return view('admin.all-pos.all-pos-returns')->with('pos',$pos)->with('count',$count);
    }
    public function export_all_available_pos()
    {
        $mytime = Carbon::now();
        return  Excel::download(new AllAvailablePosExcelView(), 'AvailablePos-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_all_customer_pos(Request $request)
    {
        $mytime = Carbon::now();
        return  Excel::download(new AllCustomerPosExcelView($request->query->get('from_date'),$request->query->get('to_date')), 'CustomerPos-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_all_returns_pos(Request $request)
    {
        $mytime = Carbon::now();
        return  Excel::download(new AllReturnsPosExcelView($request->query->get('from_date'),$request->query->get('to_date')), 'CustomerPos-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function export_all_pos_available_pdf()
    {
        $mytime = Carbon::now();
        $pos = Pos::where('customer_id', '=', null)->get();
        $count = Pos::where('customer_id', '=', null)->count();
        $pdf = PDF::loadView('admin.all-pos.available-pos-pdf', ['pos' => $pos, 'count' => $count,
            'my_time' => $mytime->toDateString()]);
        return $pdf->download('all-available-pos' . $mytime->toDateTimeString() . '.pdf');
    }

        public function export_all_pos_customer_pdf()
    {
        $mytime = Carbon::now();
        $pos= Pos::where('customer_id', '>', 0)->get();
        $count=Pos::where('customer_id', '>', 0)->count();
        $pdf = PDF::loadView('admin.all-pos.customer-pos-pdf', ['pos'=>$pos,'count'=>$count,
            'my_time'=>$mytime->toDateString()]);
        return $pdf->download('all-customer-pos'.$mytime->toDateTimeString().'.pdf');
    }
    public function show_pos_transactions($id)
    {
        $transactions = $this->transactionRepository->search(request())->where('pos_id', $id)->paginate(20);
        $transactions->appends(request()->all());
        return view('admin.all-pos.show-pos-transactions')->with('transactions',$transactions);
    }
    public function all_pos_with_two_agents()
    {
        $pos = $this->operationRepository->search(request())->where('user_id','>' ,0)->where('customer_id','>' ,0)->paginate(20);
        $pos->appends(request()->all());
        $count=$this->operationRepository->search(request())->where('user_id','>' ,0)->where('customer_id','>' ,0)->count();
        return view('admin.all-pos.all-pos-with-two-agents')->with('pos',$pos)->with('count',$count);
    }
    public function export_all_two_agents_pos(Request $request)
    {
        $mytime = Carbon::now();
        return  Excel::download(new AllTwoAgentsPosExcelView($request->query->get('from_date'),$request->query->get('to_date')), 'TwoAgentsPos-'.$mytime->toDateTimeString().'.xlsx');
    }
    public function all_pos_to_refund()
    {
        $pos = $this->operationRepository->search(request())->where('customer_id','>' ,0)->paginate(20);
        $pos->appends(request()->all());
        $count=$this->operationRepository->search(request())->where('customer_id','>' ,0)->count();
        return view('admin.all-pos.all-pos-customer-to-refund')->with('pos',$pos)->with('count',$count);
    }

}