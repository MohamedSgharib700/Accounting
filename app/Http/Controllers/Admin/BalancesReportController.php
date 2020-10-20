<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentBalance;
use App\Models\AmwalBalance;
use App\Repositories\AgentBalanceRepository;
use App\Repositories\CompanyBalanceRepository;
use View;
use Auth;
use Response;

class BalancesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(AgentBalanceRepository $AgentBalanceRepository,CompanyBalanceRepository $CompanyBalanceRepository)
    {
        $this->AgentBalanceRepository= $AgentBalanceRepository;
        $this->CompanyBalanceRepository= $CompanyBalanceRepository;
    }

    public function index()
    {
        $company_balances=AmwalBalance::sum('balance');
        $agent_balances=AgentBalance::where('type',1)->sum('balance');
        $available_agent_balances=$company_balances-$agent_balances;
        return view('admin.balances-report.index')->with('company_balances',$company_balances)->with('agent_balances',$agent_balances)->with('available_agent_balances',$available_agent_balances);

    }

    public function show_agent_balances()
    {
        $balances = $this->AgentBalanceRepository->searchFormRequest(request())->where('type',1)->paginate(20);
        $balances->appends(request()->all());
        $sum=$this->AgentBalanceRepository->searchFormRequest(request())->where('type',1)->sum('balance');
        return view('admin.balances-report.agent-balances')->with('balances',$balances)->with('sum',$sum);
    }
    public function show_company_balances()
    {
        $balances = $this->CompanyBalanceRepository->searchFormRequest(request())->paginate(20);
        $balances->appends(request()->all());
        $sum=$this->CompanyBalanceRepository->searchFormRequest(request())->sum('balance');
        return view('admin.balances-report.company-balances')->with('balances',$balances)->with('sum',$sum);
    }


}
