<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(){
        return $this->middleware('admin.auth')->except('admin_login', 'admin_login_attempt');
    }
    public function admin_login(){
        if (!Auth::guard('admin')->check()){
            return view('admin.login');
        }else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function admin_login_attempt(Request $request){
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!'
        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('admin.dashboard');
        }

    }

    public function admin_dashboard(){
        if (!Auth::guard('admin')->check()){
            return view('customer.login');
        }else {
            return view('admin.dashboard');
        }
    }


}
