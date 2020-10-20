<?php

namespace App\Http\Services;

use App\Models\AmwalBalance;
use Symfony\Component\HttpFoundation\Request;
use Hash ;

class AmwalBalanceService
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

    public function fillFromRequest(Request $request, $amwal_Balance = null)
    {
        if (!$amwal_Balance) {
            $amwal_Balance = new AmwalBalance();
        }

        // $amwal_Balance->fill($request->request->all());
        // if ($request->method() == 'post') {
        //     $user->active = $request->request->get('active', 1);
        // }
        $amwal_Balance->fill($request->request->all());

        if ($request->hasFile('image')) {
            $amwal_Balance->image = $this->uploaderService->upload($request->file('image'), 'AmwalBalances');
        }
        $amwal_Balance->save();
        return $amwal_Balance;
    }

}
