@extends('customer.layouts.app')
@section('title', 'Ticket View')
@section('content')
    <div style="width: 600px">
        <h2 class="h5 py-2">Subject: <b><i>{{ $ticket->subject }}</i></b></h2>
        <form action="{{ route('customer.ticket.reply', $ticket->id) }}" method="POST">
            @csrf @method('POST')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" disabled value="{{ auth()->guard('customer')->user()->name }}">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" value="{{ auth()->guard('customer')->user()->phone }}" id="phone" name="phone" disabled>
            </div>
            @foreach($ticket_details as $ticket_detail)
                @if(empty($ticket_detail->admin))
                <div style="border: 1px solid #ddd; border-radius: 4px" class="py-1 px-4 mb-2">
                    <div class="text-end">
                        <h6>{{ $ticket_detail->customer->name }}</h6>
                        <p class="m-0">{{ $ticket_detail->message }}</p>
                    </div>
                </div>
                @else
                <div style="border: 1px solid #ddd; border-radius: 4px" class="py-1 px-4 mb-2">
                    <div class="text-start">
                        <h6>{{ $ticket_detail->admin->name }}</h6>
                        <p class="m-0">{{ $ticket_detail->message }}</p>
                    </div>
                </div>
                @endif
            @endforeach
            <div class="mb-3">
                <label for="message" class="form-label">Reply</label>
                <textarea name="message" id="message" class="form-control" cols="30" placeholder="Type here.." rows="4"></textarea>
                @error('message')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
    </div>
@endsection
