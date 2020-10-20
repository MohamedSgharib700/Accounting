<?php

namespace App\Http\Services;

use App\Models\ContractType;
use Symfony\Component\HttpFoundation\Request;
use Hash ;

class ContarctService
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

    public function fillFromRequest(Request $request, $amwal_contract_type = null)
    {
        if (!$amwal_contract_type) {
            $amwal_contract_type = new ContractType();
        }

        // $amwal_contract_type->fill($request->request->all());
        // if ($request->method() == 'post') {
        //     $user->active = $request->request->get('active', 1);
        // }
        $amwal_contract_type->fill($request->request->all());

        if ($request->hasFile('image')) {
            $amwal_contract_type->image = $this->uploaderService->upload($request->file('image'), 'AmwalBalances');
        }
        $amwal_contract_type->save();
        return $amwal_contract_type;
    }

}
