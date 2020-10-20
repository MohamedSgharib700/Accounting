<?php

namespace App\Http\Services;

use App\Models\Transaction;
use Symfony\Component\HttpFoundation\Request;
use Hash ;
class TransactionService
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

    public function fillFromRequest(Request $request, $transaction = null)
    {
        if (!$transaction) {
            $transaction = new Transaction();
        }

        $transaction->fill($request->request->all());
        
        $transaction->save();
        return $transaction;
    }

}
