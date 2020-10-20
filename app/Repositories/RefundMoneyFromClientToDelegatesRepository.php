<?php

namespace App\Repositories;

use App\Models\RefundMoneyFromClientToDelegates;
use Symfony\Component\HttpFoundation\Request;

class RefundMoneyFromClientToDelegatesRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $customer_delegate_balances= RefundMoneyFromClientToDelegates::orderByDesc("id")
            ->when($request->get('created_date'), function ($customer_delegate_balances) use ($request) {
                return $customer_delegate_balances->whereDate('created_date', 'like', '%' . $request->query->get('created_date') . '%');
            });

        return $customer_delegate_balances;
    }

}


