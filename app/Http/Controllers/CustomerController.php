<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct(){
        return $this->middleware('customer.auth')->except('customer_login', 'customer_login_attempt');
    }

    public function customer_login(){
        if (!Auth::guard('customer')->check()){
            return view('customer.login');
        }else{
            return redirect()->route('customer.dashboard');
        }
    }

    public function customer_login_attempt(Request $request){
        $validate = $request->validate([
            'email_phone' => 'required',
            'password' => 'required'
        ],[
            'email_phone.required' => 'Email or phone is required!',
            'password.required' => 'Password is required!'
        ]);

        $email = $request->email_phone;
        $password = $request->password;

        if (Auth::guard('customer')->attempt(['email' => $email, 'password' => $password]) ||
            Auth::guard('customer')->attempt(['phone' => $email, 'password' => $password])) {
            return redirect()->route('customer.dashboard');
        }


    }

    public function customer_dashboard(){
        return view('customer.dashboard');
    }

    public function create_ticket(){
        return view('customer.create_ticket');
    }

}
