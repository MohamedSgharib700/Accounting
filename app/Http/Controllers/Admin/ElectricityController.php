<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Postpaid;
use App\Models\Prepaid;
use App\Models\Transaction;
use App\Models\AgentBalance;
use App\Models\AmwalBalance;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use View;

class ElectricityController extends Controller
{

  // protected $curlMethod ;

  // public function __construct(curlHelper $curlMethod )
  //   {
  //       $this->curlMethod = $curlMethod;
  //   }

  //This is the function of the counters

  public function getBalances() 
  {  
      $data = Http::get("http://www.momkn.org:9090/MomknServices/api/CentersBalance?UserName=7BMC17&Password=9317076&CenId=42621")->json();
      
      $balance = $data['balance'];

      $transactions = Transaction::pluck('value')->sum();

      $transactions_agents_balance = AgentBalance::where('type' , 1)->pluck('balance')->sum();

      $Amwal_balance = AmwalBalance::pluck('Balance')->sum();
      $Aman_balance = AmwalBalance::where('company_id','=','2')->sum('balance');
      $Aman_transactions = Transaction::where('company_id','=','2')->sum('value');
      $discountsForAgent =AgentBalance::where('type' , 0)->sum('balance')*-1;
      $currentAmanBalance=$Aman_balance-$Aman_transactions;
      $currentBalance =  $Amwal_balance - $transactions_agents_balance + $discountsForAgent ;

      return View::make('admin.index', ['Amwal_balance' => $Amwal_balance ,'balance' => $balance , 'transactions' => $transactions , 'currentBalance' => $currentBalance, 'transactions_agents_balance' => $transactions_agents_balance , 'discountsForAgent' => $discountsForAgent,'currentAmanBalance' => $currentAmanBalance]);
 
  }

    //end counters function


}
