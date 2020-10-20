<?php

namespace App\Repositories;

use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class LocationRepository
{

    /**
     * @param $request
     * @return $this|mixed
     */
    public function search(Request $request)
    {
        $locations = Location::orderByDesc("id")
            ->when($request->get('name'), function ($locations) use ($request) {
                return $locations->where('name', 'like', '%' . $request->query->get('name') . '%');
            });
        if ($request->filled('active')) {
            $locations->where('active', $request->query->get('active'));
        }

        return $locations;
    }

}
