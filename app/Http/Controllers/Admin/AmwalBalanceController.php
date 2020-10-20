<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\AmwalBalance;
use App\Http\Services\AmwalBalanceService;
use App\Repositories\AmwalBalanceRepository;
use App\Http\Requests\Admin\AmwalBalanceRequest;
use Validator;
use View;
use Auth;
use Response;


class AmwalBalanceController extends Controller
{
    protected $balanceService;
    protected $balanceRepository;

    public function __construct(AmwalBalanceService $balanceService , AmwalBalanceRepository $balanceRepository)
    {
        $this->balanceService = $balanceService;
        $this->balanceRepository = $balanceRepository;
    }


    public function index(Request $request)
    {
        $AmwalBalances = $this->balanceRepository->searchFormRequest(request())->paginate(20);
        $AmwalBalances->appends(request()->all());
        $sum=$this->balanceRepository->searchFormRequest(request())->sum('balance');
        $count=$this->balanceRepository->searchFormRequest(request())->count();
        $companies=Company::pluck('name', 'id');
        return View::make('admin.amwalBalances.index', ['AmwalBalances' => $AmwalBalances ,'companies'=>$companies,'sum'=>$sum,'count'=>$count]);
    }

    public function create()
    {
        return View::make('admin.amwalBalances.create');
    }
    public function amwal_report(){
        $sum=AmwalBalance::sum('balance');
        $count=AmwalBalance::count();
        return response()->json(['sum'=>$sum,'count'=>$count]);

    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'balance' => 'required|numeric',
                'company_id' => 'required',
                'notes' => 'required',
            ],
            [
                'balance.required' => trans('يجب ان تدخل الرصيد '),
                'company_id.required' => trans('يجب ان تدخل اسم الشركه '),
                'notes.required' => trans('يجب ان تدخل تعليق '),
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        } else {
            $balance = new AmwalBalance();
            $balance->company_id = $request->input('company_id');
            $balance->balance = $request->input('balance');
            $balance->notes= $request->input('notes');
            $balance->save();
            $balance->load('company');
            return response()->json($balance);
        }
    }

}