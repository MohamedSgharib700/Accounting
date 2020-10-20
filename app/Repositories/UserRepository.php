<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class UserRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $users = User::orderByDesc("id")
            ->when($request->get('name'), function ($users) use ($request) {
                return $users->where('name', 'like', '%' . $request->query->get('name') . '%');
            })
            ->when($request->get('email'), function ($users) use ($request) {
                return $users->where('email', 'like', '%' . $request->query->get('email') . '%');
            })
            ->when($request->get('area_id'), function ($users) use ($request) {
                return $users->where('area_id', 'like', '%' . $request->query->get('area_id') . '%');
            })
            ->when($request->get('code'), function ($users) use ($request) {
                return $users->where('user_code', 'like', '%' . $request->query->get('code') . '%');
             });
        if ($request->filled('active')) {
            $users->where('active', $request->query->get('active'));
        }

        return $users;
    }

    public function customersSearch(Request $request)
    {
        $customers = User::orderByDesc("id")->where('type' , 6)
            ->when($request->get('name'), function ($customers) use ($request) {
                return $customers->where('name', 'like', '%' . $request->query->get('name') . '%');
            })
            ->when($request->get('email'), function ($customers) use ($request) {
                return $customers->where('email', 'like', '%' . $request->query->get('email') . '%');
            })
            ->when($request->get('area_id'), function ($customers) use ($request) {
                return $customers->where('area_id', 'like', '%' . $request->query->get('area_id') . '%');
            });
        if ($request->filled('active')) {
            $customers->where('active', $request->query->get('active'));
        }

        return $customers;
    }

}
