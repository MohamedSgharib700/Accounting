<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use App\Models\CompanyRevenue;
use App\Models\CompanyRevenuesCategory;
use App\Models\SendFromDelegateToBanks;
use App\Models\User;
use App\Repositories\CompanyRevenuesRepository;
use App\Repositories\ExpensesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use View;
use Auth;
use Response;
class CompanyRevenueController extends Controller
{
    private $uploaderService;

    public function __construct(UploaderService $uploaderService, CompanyRevenuesRepository $CompanyRevenuesRepository)
    {
        $this->uploaderService = $uploaderService;
        $this->CompanyRevenuesRepository= $CompanyRevenuesRepository;
        
    }
    public function index(){
        $revenues = $this->CompanyRevenuesRepository->search(request())->paginate(5);
        $revenues->appends(request()->all());
        $sum=$this->CompanyRevenuesRepository->search(request())->sum('value');
        $count=$this->CompanyRevenuesRepository->search(request())->count();
        $categories=CompanyRevenuesCategory::pluck('name', 'id');
        $agents=User::where('type','=',5)->pluck('name', 'id');
        return view('admin.revenues.index')->with('revenues',$revenues)->with('categories',$categories)->with('agents',$agents)->with('sum',$sum)->with('count',$count);
    }
    public function revenue_report(){
        $sum=CompanyRevenue::sum('value');
        $count=CompanyRevenue::count();
        return response()->json(['sum'=>$sum,'count'=>$count]);

    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'value' => 'required|numeric',
                'category_id' => 'required',
            ],
            [
                'value.required' => trans('يجب ان تدخل قيمه الايراد '),
                'category_id.required' => trans('يجب ان تدخل نوع الايراد '),
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        } else {
            $revenue = new CompanyRevenue();
            $revenue->user_id = Auth::user()->id;
            $revenue->category_id = $request->input('category_id');
            $revenue->agent_id = $request->input('agent_id');
            $revenue->value = $request->input('value');
            $revenue->notes= $request->input('notes');
            if ($request->hasFile('image')) {
                $revenue->image = $this->uploaderService->upload($request->file('image'), 'transfersImages');
             }
            $revenue->save();
            $revenue->load('user');
            $revenue->load('category');
            $bankTransfer = new SendFromDelegateToBanks();
            $bankTransfer->created_by = $revenue->agent_id;
            $bankTransfer->image = $revenue->image;
            $bankTransfer->value = $revenue->value;
            $bankTransfer->number_order = mt_rand(1000,9999);
            $bankTransfer->created_at = $revenue->created_at;
            $bankTransfer->created_date = $revenue->created_at;
            $bankTransfer->save();
            
            return response()->json($revenue);
            
                
            
        }
        
    }
}
