<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Enum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('dashboard.auth.signin');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $role = auth()->user()->role;

            if(in_array($role,[Enum::ADMIN,Enum::DOCTOR,Enum::PATIENT])){
                return redirect()->route(getIndexRouteByUserRole());
            }else{
                auth()->logout();
                abort(403, 'Unauthorized');
            }

        }
        return redirect()->route('login')->with([
            'error' => 'make sure that the email or password '
        ]);
    }
    public function logout(){
        Session::flush();
        auth('web')->logout();

        return redirect()->route('login')->with([
            'success' => 'Signed out Successfully'
        ]);

    }
}
