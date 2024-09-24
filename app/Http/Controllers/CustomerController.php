<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function customer_login(){
        return view('customer.login');
    }

    

}
