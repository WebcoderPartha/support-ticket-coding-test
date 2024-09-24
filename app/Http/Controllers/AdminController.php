<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        return $this->middleware('admin.auth')->except('admin_login');
    }
    public function admin_login(){
        return view('admin.login');
    }


}
