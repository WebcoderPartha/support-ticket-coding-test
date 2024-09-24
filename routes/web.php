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
   Route::get('/dashboard', 'customer_dashboard')->name('customer.dashboard');
   Route::get('/ticket/create/', 'create_ticket')->name('customer.create_ticket');
   Route::post('/ticket/store', 'open_ticket')->name('customer.open_ticket');
   Route::get('/ticket/{ticket_id}/view', 'customer_ticket_view')->name('customer.ticket.view');
});


