<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TicketDetail;

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

    public function open_ticket(Request $request){

        $validate = $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ],[
            'subject.required' => 'Subject is required!',
            'message.required' => 'Message is required!'
        ]);

        // Create a Ticket
        $ticket = new Ticket();
        $ticket->customer_id = Auth::guard('customer')->user()->id;
        $ticket->subject = $request->subject;
        $ticket->open_date = date('Y-m-d');
        $ticket->status = 1;
        $ticket->save();

        // Ticket Detail
        $ticket_detail = new TicketDetail();
        $ticket_detail->ticket_id = $ticket->id; // ticket id
        $ticket_detail->customer_id = Auth::guard('customer')->user()->id;
        $ticket_detail->message = $request->message;
        $ticket_detail->save();

        return redirect()->route('customer.dashboard');

    }

    

}
