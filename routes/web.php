<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

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
   Route::post('/ticket/{ticket_id}/reply', 'customer_reply_ticket')->name('customer.ticket.reply');
   Route::get('/ticket/{ticket_id}/close', 'close_customer_ticket')->name('customer.ticket.close');
   Route::get('/logout', 'customer_logout')->name('customer.logout');
});

Route::controller(AdminController::class)->prefix('admin')->group(function (){
    Route::get('/', 'admin_login')->name('admin.login');
    Route::post('/', 'admin_login_attempt')->name('admin.login.attempt');
    Route::get('/dashboard', 'admin_dashboard')->name('admin.dashboard');
    Route::get('/logout', 'admin_logout')->name('admin.logout');
    Route::get('/ticket/{ticket_id}/view', 'admin_ticket_view')->name('admin.ticket_view');
    Route::post('/ticket/{ticket_id}/reply', 'admin_reply_ticket')->name('admin.reply_ticket');
    Route::get('/ticket/{ticket_id}/close', 'admin_ticket_close')->name('admin.ticket.close');

});


