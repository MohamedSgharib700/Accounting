<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContractType;
use App\Http\Services\ContarctService;
use App\Repositories\ContractRepository;
use App\Http\Requests\Admin\ContractRequest;
use View;
class ContractController extends Controller
{
    protected $contarctService;
    protected $contractRepository;
    
    public function __construct(ContarctService $contarctService , ContractRepository $contractRepository)
    {
        $this->contarctService = $contarctService;
        $this->contractRepository = $contractRepository;
    }


    public function index(Request $request)
    {   
        $contracts = $this->contractRepository->searchFormRequest(request())->paginate(20);
        $contracts->appends(request()->all());
        return View::make('admin.contracts.index', ['contracts' => $contracts ]);
    }

    public function create()
    { 
        return View::make('admin.contracts.create');
    }

    public function store(ContractRequest $request)
    {
         $balance = $this->contarctService->fillFromRequest($request);
           
        return redirect(route('contracts.index'))->with('message', trans('تم الاضافة بنجاح'));
    }
}
