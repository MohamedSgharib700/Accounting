<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use App\Models\AgentBalance;
use App\Models\User;
use App\Models\Pos;
use Response;
use Validator;
use Illuminate\Http\Request;
use View;
use Auth;
use Carbon\Carbon;


class MoreAgentsBalancesController extends Controller
{
    
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'balance' => 'required|numeric',
                'agent_id' => 'required',
            ],
            [
                'balance.required' => trans('يجب ان تدخل الرصيد '),
                'agent_id.required' => trans('يجب ان تدخل المندوبين '),
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        } else {
            $current_time =Carbon::parse(Carbon::now());
            $current_date=$current_time->addHour(2);
            $inputs = $request->except(['_token']);
            foreach ($inputs['agent_id'] as $r){
                $balances =AgentBalance::insert([
                    'balance'=>$inputs['balance'],
                    'agent_id'=>$r,
                    'supervisor'=>auth()->user()->id,
                    'type'=>1,
                    'created_at'=>$current_date,
            
                ]);
            }
            return response()->json($balances);
        }

    }
    public function discount(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'balance' => 'required|numeric',
                'agent_id' => 'required',
            ],
            [
                'balance.required' => trans('يجب ان تدخل الرصيد '),
                'agent_id.required' => trans('يجب ان تدخل المندوبين '),
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        } else {
            $current_time =Carbon::parse(Carbon::now());
            $current_date=$current_time->addHour(2);
            $inputs = $request->except(['_token']);
            foreach ($inputs['agent_id'] as $r){
                $balances =AgentBalance::insert([
                    'balance'=>$inputs['balance']*-1,
                    'agent_id'=>$r,
                    'supervisor'=>auth()->user()->id,
                    'type'=>0,
                    'created_at'=>$current_date,
                ]);
            }
            return response()->json($balances);
        }

    }
}
