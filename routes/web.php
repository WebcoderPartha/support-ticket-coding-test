<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::controller(CustomerController::class)->group(function (){
   Route::get('/', 'customer_login')->name('customer.login');
   Route::post('/', 'customer_login_attempt')->name('customer.login.attempt');
   Route::get('/', 'customer_dashboard')->name('customer.dashboard');
});


