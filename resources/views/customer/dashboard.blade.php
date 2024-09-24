@extends('customer.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="">
        @if($tickets->count())
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Open Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <th scope="row">{{ $ticket->id }}</th>
                        <td>{{ $ticket->open_date }}</td>
                        <td>{{!empty($ticket->end_date) ? $ticket->end_date : '-' }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>
                            @if($ticket->status === 1)
                                <span class="badge text-bg-primary">Opened</span>
                            @else
                                <span class="badge text-bg-danger">Closed</span>
                            @endif
                        </td>
                        <td>
                            <a class="badge text-bg-info text-white" href="{{ route('customer.ticket.view', $ticket->id) }}">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $tickets->links() }}
        @else
            <h2>You have no ticket yet!</h2>

        @endif

    </div>
@endsection
