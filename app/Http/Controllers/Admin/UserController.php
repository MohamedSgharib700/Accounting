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


class UserController extends Controller
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
        $users = $this->userRepository->search(request())->paginate(20);
        $users->appends(request()->all());
        $areas=Area::pluck('name', 'id');
        
        return View::make('admin.area_managers.index', ['users' => $users , 'areas' => $areas]);
    }

    public function store(UserRequest $request)
    {
        if($request->ajax())
        {

            $data= $this->userService->fillFromRequest($request);
            $respond['user'] = $data ;
        
        return view('admin.area_managers.row')->with($respond);

        }
    }

    public function edit($user)
    {

        $data = User::findOrfail($user);
        return response()->json($data);
        return View::make('admin.area_managers.index', ['user' => $user]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user_update=User::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'bail|required|string|max:255',
                'email' =>  [
                            'required',
                            Rule::unique('users')->ignore($user_update->id),
                        ],
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'active'=>'integer',
                'area_id'=>'integer'
            ],
            [
                'name.required' => trans('يجب ان تدخل الاسم'),
                'email.required' => trans('يجب ان تدخل البريد الالكتروني'),
                'email.unique' => trans('البريد الالكتروني مستخدم من قبل'),
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray())
                , 400);
        }else{
            if($request->hasFile('image')){
                $old_user = User::find($id);
                $this->uploaderService->deleteFile($old_user->image);
                $user =User::where('id', $id)->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'type'=>'2',
                    'area_id'=>$request->input('area_id'),
                    'phone'=>$request->input('phone'),
                    'image'=> $this->uploaderService->upload($request->file('image'), 'users')
                ]);
                $json=$this->show($id);
                return response()->json($json);
            }
            else{
                $user =User::where('id', $id)->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'type'=>'2',
                    'phone'=>$request->input('phone'),
                    'area_id'=>$request->input('area_id'),
                ]);
                $json=$this->show($id);
                return response()->json($json);
            }
        }
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
