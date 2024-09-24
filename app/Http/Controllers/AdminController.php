<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketDetail;
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
        $tickets = Ticket::with('customer')->orderBy('id', 'DESC')->take(10)->paginate();
        return view('admin.dashboard',compact('tickets'));
    }

    public function admin_logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function admin_ticket_view($ticket_id){
        $ticket = Ticket::with('customer')->where('id', $ticket_id)->first();
        $ticket_details = TicketDetail::with('admin', 'customer')->where('ticket_id', $ticket->id)->orderBy('id', 'asc')->get();

        return view('admin.ticket_view', compact('ticket', 'ticket_details'));
    }

    public function admin_reply_ticket(Request $request, $ticket_id){
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
            $ticket_detail->admin_id = Auth::guard('admin')->user()->id;
            $ticket_detail->save();
        }

        return redirect()->back();

    }

    public function admin_ticket_close($ticket_id){
        $ticket = Ticket::find($ticket_id);
        $ticket->end_date = date('d F, Y | h:i:sA');
        $ticket->status = 2; // 1 for opened 2 for close
        $ticket->save();
        return redirect()->route('admin.dashboard');
    }


}
