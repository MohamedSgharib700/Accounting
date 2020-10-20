<?php

namespace App\Http\Services;

use App\Http\Resources\Revenues;
use App\Models\Revenue;
use App\Repositories\RevenueRepository;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;
use File;
use Barryvdh\DomPDF\Facade as PDF;

class RevenueService
{
    protected $revenueRepository;

    public function __construct(RevenueRepository $revenueRepository)
    {
        $this->revenueRepository = $revenueRepository;
    }

    public function fillFromRequest(Request $request, $revenue = null)
    {
        if (!$revenue) {
            $revenue = new Revenue();
        }
        $revenue->fill($request->request->all());

        if (!$request->filled('agent_id')) {
            $revenue->agent_id = auth()->user()->id;
        }
        $revenue->save();

        return $revenue;
    }

    public function exportExcel()
    {
        $headings = [
            ["Revenues List"],
            ['#',
                "Agent",
                "Customer",
                "POS",
                "Value",
                "Created Date"]
        ];

        $list = $this->revenueRepository->searchFormRequest(request())->get();
        $listObjects = Revenues::collection($list);

        $path = public_path() . '/assets/uploads/Exports/';
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $fileName = date('YmdHis') . mt_rand() . '_Revenues.' . 'xlsx';
        Excel::store(new ExportService($listObjects, $headings), '/Exports/'. $fileName);

        return asset('uploads/Exports/'.$fileName);
    }

    public function exportPDF()
    {
        $data = $this->revenueRepository->searchFormRequest(request())->get();
        $pdf = PDF::loadView('export.revenues.index', ['data' => $data]);

        $path = public_path() . '/uploads/Exports/';
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $fileName = date('YmdHis') . mt_rand() . '_Revenues.' . 'pdf';
        $pdf->save($path . '/' . $fileName);

        return asset('uploads/Exports/'.$fileName);
    }
}
