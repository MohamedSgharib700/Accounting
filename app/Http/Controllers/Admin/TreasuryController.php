<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CompanyRevenuesRepository;
use App\Repositories\ExpensesRepository;
use Illuminate\Http\Request;

class TreasuryController extends Controller
{
    protected $expensesRepository;
    protected $revenuesRepository;

    public function __construct( CompanyRevenuesRepository $revenuesRepository , ExpensesRepository $expensesRepository)
    {
        $this->revenuesRepository = $revenuesRepository;
        $this->expensesRepository  = $expensesRepository;
    }


    public function index(Request $request)
    {
        $expenses = $this->expensesRepository->searchFormRequest(request())->paginate(20);
        $expenses->appends(request()->all());
        $expensesSum =$this->expensesRepository->searchFormRequest(request())->sum('value');
        $revenues = $this->revenuesRepository->search(request())->paginate(5);
        $revenues->appends(request()->all());
        $revenuesSum = $this->revenuesRepository->search(request())->sum('value');

        $treasuryBalance = $revenuesSum - $expensesSum ;

        return view('admin.treasuries.index', ['expenses' => $expenses ,'expensesSum' => $expensesSum, 'revenues' => $revenues
            ,'revenuesSum' => $revenuesSum , 'treasuryBalance' => $treasuryBalance]);
    }

}
