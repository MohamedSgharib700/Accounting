<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use App\Models\User;
use Illuminate\Validation\Rule;
use Response;
use Validator;
use App\Models\Area;
use App\Http\Services\UserService;
use App\Repositories\UserRepository;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use View;
use Auth;

class CustomerController extends Controller
{
    protected $userService;
    protected $userRepository;
    private $uploaderService;

    public function __construct(UserService $userService, UserRepository $userRepository, UploaderService $uploaderService)
    {
      //create read update delete permission for user 
        //  $this->middleware(['permission:read_users'])->only('index');
        //  $this->middleware(['permission:create_users'])->only('create');
        //  $this->middleware(['permission:update_users'])->only('edit');
        //  $this->middleware(['permission:delete_users'])->only('destroy');

        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->uploaderService = $uploaderService;
    } //end of constructor 

    public function index(Request $request)
    {
        $customers = $this->userRepository->customersSearch(request())->paginate(10);
        $customers->appends(request()->all());
        $areas = Area::pluck('name', 'id');
        
        return View::make('admin.customers.index', ['customers' => $customers , 'areas' => $areas]);
    }

    public function create()
    {
        $areas = Area::all();
        return View::make('admin.customers.create',compact('areas'));
    }

    public function store(UserRequest $request)
    {
        $this->userService->fillFromRequest($request);
        return redirect(route('customers.index'))->with('success', trans('تم اضافة العميل بنجاح'));
    }

    public function edit(User $customer)
    {
        return View::make('admin.customers.edit', ['customer' => $customer]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, User $customer)
    {
        $this->userService->fillFromRequest($request, $customer);
        return redirect(route('customers.index'))->with('success', trans('تم اضافة الكود بنجاح'));
    }

    public function changePassword(User $user)
    {
        return View::make('admin.area_managers.change_password' , ['user' => $user]);
    }

    public function updatePassword(Request $request)
    {
        // return $request->all();
        $this->validate($request,[

            'oldpassword'=>'required',
            'password'=>'required|confirmed'
            
            ]);
            
            $userPassword = Auth::user()->password;
            
            if(Hash::check($request->oldpassword , $userPassword)){
            
             $user = User::find(Auth::id());
            
             $user->password = Hash::make($request->password);
            
             $user->update();
            
            
             return back()->with('success' , 'The update was successful');

            }else{
            
              return back()->with('errorMsge' , 'The password you entered does not match our records .');
            }
    }

    public function destroy(User $user)
    {
        $this->uploaderService->deleteFile($user->image);
         $user->delete();
        return redirect()->back()->with('success', trans('item_deleted_successfully'));
    }
    
    public function changeActive($id,$active)
    {
        $users = User::find($id);
        $users->active = $active;
        $users->save();
        return response()->json($users);
    }

}
