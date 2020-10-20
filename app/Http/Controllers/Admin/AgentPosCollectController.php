<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AgentPosCollectRepository;

use Illuminate\Http\Request;
use Validator;
use View;
use Auth;
use Redirect,Response;

use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\AgentPosCollect;
use Illuminate\Support\Facades\DB;
use PDF;
class AgentPosCollectController extends Controller
{
    protected $userService;
    protected $userRepository;
    private $uploaderService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(AgentPosCollectRepository $AgentPosCollectRepository)
    {
        //create read update delete permission for user
        $this->AgentPosCollectRepository= $AgentPosCollectRepository;
    }


    
    public function index(){
        $transactions = $this->AgentPosCollectRepository->search(request())->paginate(20);
        $transactions->appends(request()->all());
        $sum=$this->AgentPosCollectRepository->search(request())->sum('value');
        $count=$this->AgentPosCollectRepository->search(request())->count();
        return view('admin.agent-pos-collect.index')->with('transactions',$transactions)->with('sum',$sum)->with('count',$count);
    }
    public function export_daily_commissions()
    {
        $mytime = Carbon::now();
        return  Excel::download(new DailyCommissionsExcelView(), 'DailyCommissions-'.$mytime->toDateTimeString().'.xlsx');
    }
  


}
