<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyRevenuesCategory;
use App\Repositories\CompanyRevenuesCategoryRepository;
use Illuminate\Http\Request;
use Validator;
use View;
use Auth;
use Response;
class CompanyRevenuesCategoriesController extends Controller
{

    public function __construct( CompanyRevenuesCategoryRepository $CompanyRevenuesCategoryRepository)
    {
        $this->CompanyRevenuesCategoryRepository= $CompanyRevenuesCategoryRepository;
    }
    public function index(){
        $revenues = $this->CompanyRevenuesCategoryRepository->search(request())->paginate(5);
        $revenues->appends(request()->all());
        return view('admin.revenues-categories.index')->with('revenues',$revenues);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string',
            ],
            [
                'name.required' => trans('يجب ان تدخل اسم التصنيف '),
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        } else {
            $revenue = new CompanyRevenuesCategory();
            $revenue->name = $request->input('name');
            $revenue->save();
            return response()->json($revenue);
        }
    }
}
