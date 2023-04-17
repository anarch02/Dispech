<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $data = $request->validate([
            'login' => ['required'],
            'password' => ['required']
        ]);

        if(auth('web')->attempt($data))
        {
            return redirect(route('organization.dashboard'));
        }
        elseif(auth('admin')->attempt($data))
        {
            return redirect(route('admin.dashboard'));
        }
            

        return view('auth.login');
    }

    public function logout(){

        if(auth('web')->check())
        {
            auth('web')->logout();
        }
        elseif(auth('admin')->check())
        {
            auth('admin')->logout();
        }
        
        return redirect(route('login'));
    }
}
