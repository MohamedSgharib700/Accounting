<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Installment;
use App\Repositories\InstallmentRepository;

use View;


class InstallmentController extends Controller
{
 
  
    protected $installmentRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct( InstallmentRepository $installmentRepository)
    {
   
        $this->installmentRepository = $installmentRepository;

    }

    public function index(Request $request)
    {
        $installments = $this->installmentRepository->searchFormRequest(request())->paginate(20);

        $installments->appends(request()->all());
        $installment_total_values=Installment::sum('value');

        return view('admin.installments.index', ['installments' => $installments , 'installment_total_values' => $installment_total_values]);

    }
    
}
