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
});


