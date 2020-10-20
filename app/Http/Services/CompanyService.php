<?php

namespace App\Http\Services;

use App\Models\Company;
use Symfony\Component\HttpFoundation\Request;
use Hash ;

class CompanyService
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

    public function fillFromRequest(Request $request, $company = null)
    {
        if (!$company) {
            $company = new Company();
        }

        $company->fill($request->request->all());
        if ($request->method() == 'post') {
            $user->active = $request->request->get('active', 1);
        }
        $company->fill($request->request->all());

        if ($request->hasFile('image')) {
            $company->image = $this->uploaderService->upload($request->file('image'), 'companies');
        }
        $company->save();
        return $company;
    }

}
