<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\Events\JobFailed;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\UserRole;
use Laravel\Socialite\Facades\Socialite;
use App\Repository\interfaces\IUserRepository;
use App\Repository\implementation\UserRepository;
use Exception;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{
    private IUserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return View('auth.users.index', compact("users"));
    }
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return View("auth.login");
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }
    public function auth(Request $request)
    {

        $credentails = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $credentails['email'])->first();
        return $this->validateUser($user, $credentails);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('auth.users.create')->with('roles', Role::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        return $this->storeUser($request);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        return view('auth.users.details')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return View('auth.users.edit')->with('user', $user)->with('roles', Role::all());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return $this->updateUser($user, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        return View('auth.users.profile')->with('user', $user);
    }
    public function destroy(User $user)
    {
        $user->deleteOrFail();
        $this->deletePhoto($user);
        return response('success');
    }
    public function changeStatus(User $user, Request $request)
    {
        $lock = $request->lock;
        if ($lock != null) {
            if ($lock) {
                $this->lockUser($user);
            } else {
                $this->unLockUser($user);
            }
            return response('success');
        }
        $reset = $request->resetPassword;
        if ($reset) {
            $user->password = bcrypt($reset);
            $user->save();
            return response('success');
        }
        return null;
    }

    public function storeUser(StoreUserRequest $request)
    {
        $user = $request->validated();
        $roles = $request->validate([
            'roles' => 'required'
        ]);
        $user['password'] = bcrypt($user['password']);
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $f = $file->move(public_path('includes/img/users/1'), $filename);
            $this->toResizeImage($filename, '2', 20);
            $this->toResizeImage($filename, '3', 10);
            $user['photo'] = 'includes/img/users/3/' . $filename;
            $newUser = new User($user);
            $newUser->created_by = Auth::user()->id;
            $newUser->save();
            //Roles addition for user
            foreach ($roles['roles'] as $role) {
                $userRole = new UserRole;
                $userRole->role_id = intval($role);
                $userRole->user_id = $newUser->id;
                $userRole->save();
            }
            return response('success');
        }
        return abort('failed');
    }

    public function updateProfile( Request $request)
    {
       $user = User::findorfail(Auth::user()->id);
        if ($request->filled("oldpassword") && $request->filled('newpassword')) {
            if (Hash::check($request->oldpassword, $user->password)) {
                $user->password = bcrypt($request->newpassword);
                $user->save();
                Auth::logout();
                return response('success');
            } else {
                return response('password not mached!');
            }
        }
        if ($request->filled("fullname") && $request->filled('job_title')) {
            $user->fullname = $request->fullname;
            $user->job_title = $request->job_title;
            $user->save();
            return response('success');
        }
        return abort("failed");
    }

    public function updateUser(User $user, Request $request)
    {
        $userInfo = $request->validated();
        $roles = $request->validate([
            'roles' => 'required'
        ]);
        if ($request->file('photo')) {
            $this->deletePhoto($user);
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $f = $file->move(public_path('includes/img/users/1'), $filename);
            $this->toResizeImage($filename, '2', 20);
            $this->toResizeImage($filename, '3', 10);
            $userInfo['photo'] = 'includes/img/users/3/' . $filename;
        }
        $user->fill($userInfo);
        $user->update_by = Auth::user()->id;
        $user->save();
        //Roles addition for user
        UserRole::where('user_id', $user->id)->delete();
        foreach ($roles['roles'] as $role) {
            $userRole = new UserRole;
            $userRole->role_id = intval($role);
            $userRole->user_id = $user->id;
            $userRole->created_by = Auth::user()->id;
            $userRole->save();
        }
        return response('success');
    }
    public function deletePhoto(User $user)
    {
        for ($i = 1; $i <= 3; $i++) {
            $file = public_path(str_replace('/3/', '/' . $i . '/', $user->photo));
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
    public function validateUser($user, $credentails)
    {
        if ($user == null) {
            return response('email is not exist!');
        } else if ($user->islock) {
            return response('Your account is locked, Please try again on ' . $user->lock_until);
        } else if (!Hash::check($credentails['password'], $user->password)) {
            $user->count += 1;
            if ($user->count > 4) {
                $user->islock = true;
                $user->lock_until = date('Y-m-d H:i:s', strtotime(' + 3 hours')); //user will lock for 3 hours
            }
            $user->save();
            return response('password is incorrect!');
        }
        if (Auth::attempt($credentails)) {
            $this->resetError($user);
            return response('success');
        }
        return null;
    }

    function resetError($user)
    {
        $this->unLockUser($user);
    }
    function unLockUser($user)
    {
        $user->count = 0;
        $user->islock = false;
        $user->lock_until = now();
        $user->save();
    }
    //Compress user image  $percent should be between 0-100
    public function toResizeImage($filename, $savePath, $percent)
    {
        $image = Image::make(public_path('includes/img/users/1/' . $filename));
        $w = $image->width() / 100 * $percent;
        $h = $image->height() / 100 * $percent;
        $image->resize($w, $h);
        $image->save(public_path('includes/img/users/' . $savePath . '/' . $filename));
        return "success";
    }

    function lockUser($user)
    {
        $user->islock = true;
        $user->lock_until = date('Y-m-d H:i:s', strtotime(' + 3 hours')); //user will lock for 3 hours
        $user->save();
    }
}
