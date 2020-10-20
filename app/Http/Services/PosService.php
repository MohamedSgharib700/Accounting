<?php

namespace App\Http\Services;

use App\Models\Pos;
use Symfony\Component\HttpFoundation\Request;
use Hash ;
class PosService
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

    public function fillFromRequest(Request $request, $po = null)
    {
        if (!$po) {
            $po = new Pos();
        }

        $po->fill($request->request->all());
        // if ($request->method() == 'post') {
        //     $pos->active = $request->request->get('active', 1);
        // }
        // $pos->fill($request->request->all());

        if ($request->hasFile('image')) {
            $po->image = $this->uploaderService->upload($request->file('image'), 'pos');
        }
        $po->save();
        return $po;
    }

}
