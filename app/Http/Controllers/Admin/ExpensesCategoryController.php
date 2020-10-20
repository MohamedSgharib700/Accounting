<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Http\Services\ExpenseCategoryServices;
use App\Repositories\ExpenseCategoryRepository;
use App\Http\Requests\Admin\ExpenseCategoryRequest;
use View;

class ExpensesCategoryController extends Controller
{
    protected $expensesService;
    protected $expensesRepository;
    
    public function __construct(ExpenseCategoryServices $expensesService , ExpenseCategoryRepository $expensesRepository)
    {
        $this->expensesService = $expensesService;
        $this->expensesRepository = $expensesRepository;
    }


    public function index(Request $request)
    {   
        $expensesBalances = $this->expensesRepository->searchFormRequest(request())->paginate(20);
        $expensesBalances->appends(request()->all());
        return View::make('admin.expensesBalanceCategories.index', ['expensesBalances' => $expensesBalances ]);
    }

    public function create()
    { 
        return View::make('admin.expensesBalanceCategories.create');
    }

    public function store(ExpenseCategoryRequest $request)
    {
         $balance = $this->expensesService->fillFromRequest($request);
           
        return redirect(route('expensesBalanceCategories.index'))->with('message', trans('تم الاضافة بنجاح'));
    }
}
