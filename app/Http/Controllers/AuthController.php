<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\sidenavbar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function logoutaction(Request $request){

        $this->guard()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('login'));
    }

    public function login(Request $request) {
        // dd($request->all());

        $user = User::where('user_name',$request->user_name)->first();
        // dd($user->userID);
        if($user && Hash::check($request->user_password,$user->user_password)){
            $d =Auth::login(User::find($user->userID));
            $role = User::find($user->userID)->role1($user->userID);
            // dd($role);
            session(['role' => $role]);
            return redirect()->route('project.admin');
            // dd($d);
        }{
            return redirect()->route('index')->withError('Authentication Failed!');
        }
    }

    public function logout(Request $request) {
        // $this->logoutSso();
        Auth::guard()->logout();
        $request->session()->invalidate();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('index'))->withSuccess('Logout Successfull');
    }
}
