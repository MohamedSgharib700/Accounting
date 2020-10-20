<?php

namespace App\Http\Services;

use App\Models\BankTransfer;
use App\Models\User;
use App\Repositories\AgentBalanceRepository;
use App\Repositories\BankTransferRepository;
use App\Repositories\PosChargeRepository;
use Symfony\Component\HttpFoundation\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use File;

class AgentService
{
    protected $posChargeRepository;
    protected $agentBalanceRepository;
    protected $bankTransferRepository;
    protected $uploaderService;

    public function __construct(PosChargeRepository $posChargeRepository, AgentBalanceRepository $agentBalanceRepository, BankTransferRepository $bankTransferRepository, UploaderService $uploaderService)
    {
        $this->posChargeRepository = $posChargeRepository;
        $this->agentBalanceRepository = $agentBalanceRepository;
        $this->bankTransferRepository = $bankTransferRepository;
        $this->uploaderService = $uploaderService;
    }

    public function bankTransferFormRequest(Request $request, $transfer = null)
    {
        if (!$transfer) {
            $transfer = new BankTransfer();
        }

        $transfer->fill($request->request->all());
        if (!$request->filled('agent_id')) {
            $transfer->agent_id = auth()->user()->id;
        }
        if (!empty($request->file('receipt'))) {
           $transfer->receipt = $this->uploaderService->upload($request->file('receipt'), 'BankTransfers');
        }

        $transfer->save();

        return $transfer;
    }

    public function exportExcel(User $user)
    {
        $headings = [
            ["Agent Balance (". $user->name . ")"],
            [
                "All Balance",
                "Current Balance",
                "All Pos Charge",
                "Revenues",
                "Needed Revenues"
            ]
        ];

        $agentAllBalance = $user->balances->sum('balance');
        $agentAllPosCharge = $user->posCharges->sum('value');
        $revenues = $user->revenues->sum('value');
        $list = collect([
            (object) [
                "agentAllBalance" => $agentAllBalance,
                "agentCurrentBalance" => $agentAllBalance - $agentAllPosCharge,
                "agentAllPosCharge" => $agentAllPosCharge,
                "revenues" => $revenues,
                "neededRevenues" => $agentAllPosCharge - $revenues
            ],
        ]);

        $path = public_path() . '/assets/uploads/Exports/';
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $fileName = date('YmdHis') . mt_rand() . 'Agent Balance.' . 'xlsx';
        Excel::store(new ExportService($list, $headings), '/Exports/'. $fileName);

        return asset('uploads/Exports/'.$fileName);
    }

    public function exportPDF(User $user)
    {
        $agentAllBalance = $user->balances->sum('balance');
        $agentAllPosCharge = $user->posCharges->sum('value');
        $revenues = $user->revenues->sum('value');
        $data = [
            "agent" => $user->name,
            "agentAllBalance" => $agentAllBalance,
            "agentAllPosCharge" => $agentAllPosCharge,
            "agentCurrentBalance" => $agentAllBalance - $agentAllPosCharge,
            "revenues" => $revenues,
            "neededRevenues" => $agentAllPosCharge - $revenues
        ];


        $pdf = PDF::loadView('export.agents.balance', ['data' => $data]);

        $path = public_path() . '/uploads/Exports/';
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $fileName = date('YmdHis') . mt_rand() . '_Agent Balance.' . 'pdf';
        $pdf->save($path . '/' . $fileName);

        return asset('uploads/Exports/'.$fileName);
    }
}
