<?php

namespace App\Http\Services;

use App\Models\Service;
use Symfony\Component\HttpFoundation\Request;
use Hash ;
class ServiceService
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

    public function fillFromRequest(Request $request, $service = null)
    {
        if (!$service) {
            $service = new Service();
        }

        $service->fill($request->request->all());
        if ($request->method() == 'post') {
           $service->active = $request->request->get('active', 1);
        }
        $service->fill($request->request->all());

        if ($request->hasFile('image')) {
            $service->image = $this->uploaderService->upload($request->file('image'), 'users');
        }
        $service->save();
        return $service;
    }

}
