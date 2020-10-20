<?php

namespace App\Http\Services;

use App\Models\Location;
use Symfony\Component\HttpFoundation\Request;

class LocationService
{
    public function fillFromRequest(Request $request, $location = null)
    {
        if (!$location) {
            $location = new Location();
        }

        $location->fill($request->request->all());
        $location->save();

        return $location;
    }
}
