<?php

namespace App\Repositories;

use App\Models\TransferCreditFromDelegateToCustomers;
use Symfony\Component\HttpFoundation\Request;

class TransferCreditCustomerRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $customer_balances= TransferCreditFromDelegateToCustomers::orderByDesc("id")
            ->when($request->get('money'), function ($customer_balances) use ($request) {
                return $customer_balances->where('money', 'like', '%' . $request->query->get('money') . '%');
            })
            ->when($request->get('created_date'), function ($customer_balances) use ($request) {
                return $customer_balances->whereDate('created_at', 'like', '%' . $request->query->get('created_date') . '%');
            });

        return $customer_balances;
    }

}


