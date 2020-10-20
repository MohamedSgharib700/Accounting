<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Http\Services\ExpensesService;
use App\Repositories\ExpensesRepository;
use App\Http\Requests\Admin\ExpensesRequest;
use View;

class ExpensesController extends Controller
{
    protected $expensesService;
    protected $expensesRepository;
    
    public function __construct(ExpensesService $expensesService , ExpensesRepository $expensesRepository)
    {
        $this->expensesService = $expensesService;
        $this->expensesRepository = $expensesRepository;
    }


    public function index(Request $request)
    {   
        $expensesBalances = $this->expensesRepository->searchFormRequest(request())->paginate(20);
        $expensesBalances->appends(request()->all());
        $sum=$this->expensesRepository->searchFormRequest(request())->sum('value');
        $count=$this->expensesRepository->searchFormRequest(request())->count();
        return View::make('admin.expensesBalances.index', ['expensesBalances' => $expensesBalances ])->with('sum',$sum)->with('count',$count);
    }

    public function create()
    { 
        $categories=ExpenseCategory::all();
        return View::make('admin.expensesBalances.create',compact('categories'));
    }

    public function store(ExpensesRequest $request)
    {
         $balance = $this->expensesService->fillFromRequest($request);
           
        return redirect(route('expensesBalances.index'))->with('message', trans('تم اضافه الرصيد المصروف بنجاح'));
    }

}
