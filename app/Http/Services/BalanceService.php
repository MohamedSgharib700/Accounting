<?php

namespace App\Http\Services;

use App\Models\AgentBalance;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Request;
use Hash ;
use Carbon\Carbon;
use Session;

class BalanceService
{

    private $uploaderService;

    /**
     * UserService constructor.
     * @param UploaderService $uploaderService
     */
    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    public function fillFromRequest(Request $request, $balance = null)
    {   
        $data = Http::get("http://www.momkn.org:9090/MomknServices/api/CentersBalance?UserName=7BMC17&Password=9317076&CenId=42621")->json();
        
        $momkn_balance = $data['balance'];

        $transactions = Transaction::pluck('value')->sum();

        $currentBalance =  $momkn_balance - $transactions ;

        if (!$balance) {
            $balance = new AgentBalance();
        }
        $current_time =Carbon::parse(Carbon::now());

        $balance->fill($request->request->all());
        $balance->type = $request->request->type= 1; 
        $balance->created_at=$current_time->addHour(2);
        $balance->save();
        return $balance;
            
    }

    public function fillFromRequestDiscount(Request $request, $balance = null)
    {   
        $data = Http::get("http://www.momkn.org:9090/MomknServices/api/CentersBalance?UserName=7BMC17&Password=9317076&CenId=42621")->json();
        
        $momkn_balance = $data['balance'];

        $transactions = Transaction::pluck('value')->sum();

        $currentBalance =  $momkn_balance - $transactions ;

        if (!$balance) {
            $balance = new AgentBalance();
        }

        $balance->fill($request->request->all());
        $current_time =Carbon::parse(Carbon::now());
         $balance->type = $request->request->type= 0;
         $balance->balance = $request->input('balance')*-1;
         $balance->created_at=$current_time->addHour(2);
        $balance->save();
        return $balance;
            
    }

}
