@extends('customer.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div style="width: 600px">
        <h2>Open a Ticket</h2>
        <form action="{{ route('customer.open_ticket') }}" method="POST">
            @csrf @method('POST')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" disabled value="{{ auth()->guard('customer')->user()->name }}">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ auth()->guard('customer')->user()->email }}" id="email" name="email" disabled>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" value="{{ auth()->guard('customer')->user()->phone }}" id="phone" name="phone" disabled>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" placeholder="Enter subject" id="subject" name="subject">
                @error('subject')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Write a message</label>
                <textarea name="message" id="message" class="form-control" cols="30" placeholder="Type here.." rows="4"></textarea>
                @error('subject')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
