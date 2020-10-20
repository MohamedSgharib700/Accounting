<?php


namespace App\Http\Services;
use App\Http\Requests\Admin\SupervisorRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Hash ;
use Illuminate\Support\Str;
use Response;
class SupervisorService
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

    public function fillFromRequest(Request $request, $user = null)
    {
        if (!$user) {
            $user = new User();
        }

        $user->fill($request->request->all());
        $user->type ='2';

        if ($request->filled('password')) {
            $user->password = $request->request->get('password');
        }

        if ($request->hasFile('image')) {
            $user->image = $this->uploaderService->upload($request->file('image'), 'users');
        }

        $user->save();
        $user->load('area');

        return response()->json($user);
    }
}
