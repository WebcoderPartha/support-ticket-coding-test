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
        $tickets = Ticket::orderBy('id', 'DESC')->take(10)->paginate();
        return view('customer.dashboard', compact('tickets'));
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
        $ticket->open_date = date('d F, Y | h:i:sA');
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

    public function customer_ticket_view($ticket_id){
        $ticket = Ticket::where('id', $ticket_id)->first();
        $ticket_details = TicketDetail::with('admin', 'customer')->where('ticket_id', $ticket->id)->orderBy('id', 'asc')->get();

        return view('customer.ticket_view', compact('ticket', 'ticket_details'));
    }

    public function customer_reply_ticket(Request $request, $ticket_id){
        $validate = $request->validate([
            'message' => 'required'
        ],[
            'message.required' => 'Message is required!'
        ]);

        $ticket = Ticket::where('id', $ticket_id)->first();
        if ($ticket){
            $ticket_detail = new TicketDetail();
            $ticket_detail->ticket_id = $ticket->id;
            $ticket_detail->message = $request->message;
            $ticket_detail->customer_id = Auth::guard('customer')->user()->id;
            $ticket_detail->save();
        }

        return redirect()->back();

    }

    public function close_customer_ticket($ticket_id){
        $ticket = Ticket::find($ticket_id);
        $ticket->end_date = date('d F, Y | h:i:sA');
        $ticket->status = 2; // 1 for opened 2 for close
        $ticket->save();
        return redirect()->route('customer.dashboard');
    }

    public function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }

}
