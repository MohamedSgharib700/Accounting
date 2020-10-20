<?php

namespace App\Http\Services;

use App\Http\Resources\Installments;
use App\Models\Installment;
use App\Repositories\InstallmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use File;
use Barryvdh\DomPDF\Facade as PDF;

class InstallmentService
{
    protected $installmentRepository;

    public function __construct(InstallmentRepository $installmentRepository)
    {
        $this->installmentRepository = $installmentRepository;
    }

    public function fillFromRequest(Request $request, $installment = null)
    {
        if (!$installment) {
            $installment = new Installment();
        }
        $installment->fill($request->request->all());

        if (!$request->filled('agent_id')) {
            $installment->agent_id = auth()->user()->id;
        }
        $installment->save();

        return $installment;
    }

    public function generateInstallments(Request $request)
    {
        $dueDate = $request->get('first_due_date');
        for ($i = 0; $i < $request->get('installments_number'); $i++) {
            if ($i != 0) {
                $dueDate = Carbon::parse(Carbon::parse($dueDate)->addMonth()->format('Y-m-d'));
            }

            $request->request->add([
                'value' => $request->get('pos_price') / $request->get('installments_number'),
                'due_date' => $dueDate,
            ]);
            $this->fillFromRequest($request);
        }
        return true;
    }

    public function exportExcel()
    {
        $headings = [
            ["Installments List"],
            ['#',
                "Agent",
                "Customer",
                "POS",
                "Value",
                "Due Date",
                "Payment Date",
                "status"]
        ];

        $list = $this->installmentRepository->searchFormRequest(request())->get();
        $listObjects = Installments::collection($list);

        $path = public_path() . '/assets/uploads/Exports/';
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $fileName = date('YmdHis') . mt_rand() . '_Installments.' . 'xlsx';
        Excel::store(new ExportService($listObjects, $headings), '/Exports/'. $fileName);

        return asset('uploads/Exports/'.$fileName);
    }

    public function exportPDF()
    {
        $data = $this->installmentRepository->searchFormRequest(request())->get();
        $pdf = PDF::loadView('export.installments.index', ['data' => $data]);

        $path = public_path() . '/uploads/Exports/';
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $fileName = date('YmdHis') . mt_rand() . '_Installments.' . 'pdf';
        $pdf->save($path . '/' . $fileName);

        return asset('uploads/Exports/'.$fileName);
    }
}
