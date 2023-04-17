<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        if(auth('admin')->check()){
            return redirect(route('admin.dashboard'));
        };

        return view('auth.login');
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if(auth('admin')->attempt($data)){
            return redirect(route('admin.dashboard'));
        };

        return view('auth.login');
    }

    public function logout(Request $request){
        auth('admin')->logout();
        return redirect(route('login'));
    }
}
