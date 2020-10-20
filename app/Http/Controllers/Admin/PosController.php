<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PosRepository;
use App\Models\Transaction;
use App\Models\TransferCreditFromDelegateToCustomers;
use App\Models\Pos;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Exports\TransactionExport; 
use Maatwebsite\Excel\Facades\Excel; 
use PDF;
use View;



class PosController extends Controller
{
    protected $posRepository;
    protected $transactionRepository;

    public function __construct(PosRepository $posRepository , TransactionRepository $transactionRepository  )
    {
        $this->posRepository = $posRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function show_pos($id)
    {
        $agent = User::find($id);
        $pos = $this->posRepository->search(request())->where('user_id', $id)->paginate(20);
        $customer_balance=TransferCreditFromDelegateToCustomers::where('created_by', $id)->sum('money');
        $pos->appends(request()->all());
        return view('admin.agents.show-pos' , ['agent' => $agent,'customer_balance' => $customer_balance])->with('pos',$pos);
    }


    public function show_pos_transactions($id)
    {
        $pos = Pos::find($id);
        $transactions = $this->transactionRepository->search(request())->where('pos_id', $id)->paginate(20);
        $transactions->appends(request()->all());
        return view('admin.agents.show-pos-transactions' , ['pos'=> $pos])->with('transactions',$transactions);
    }

    public function exportExcel($id){

        return Excel::download(new TransactionExport($id), 'PosTransactions.xlsx'); 
    } 

    public function exportPdf(Pos $device){
        
        $pdf = PDF::loadview('admin.agents.PosTransactions_pdf_form' ,['device' => $device]);
        return $pdf->download('PosTransactions.pdf'); 
    } 

}

