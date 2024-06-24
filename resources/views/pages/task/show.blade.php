@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Task Details</h1>
        <div class="card">
            <div class="card-header">
                Task #{{ $task->id }}
            </div>
            <div class="card-body">
                <p><strong>Event Stage:</strong> {{ $task->event_stage }}</p>
                <p><strong>Status:</strong> {{ $task->status }}</p>
                <p><strong>Start Date:</strong> {{ $task->start_date }}</p>
                <p><strong>End Date:</strong> {{ $task->end_date }}</p>
                <p><strong>Quote:</strong> {{ $task->quote }}</p>
            </div>
        </div>

        <h2 class="mt-5">Associated Ticket Details</h2>
        <div class="card">
            <div class="card-header">
                Ticket #{{ $task->ticket->id }}
            </div>
            <div class="card-body">
                <p><strong>State:</strong> {{ $task->ticket->state }}</p>
                <p><strong>Ticket Date:</strong> {{ $task->ticket->ticket_date }}</p>
                <p><strong>Ticket Type:</strong> {{ $task->ticket->ticket_type }}</p>
                <p><strong>Ticket Points:</strong> {{ $task->ticket->ticket_points }}</p>
                <p><strong>Existing Points:</strong> {{ $task->ticket->existing_points }}</p>
                <p><strong>City:</strong> {{ $task->ticket->ticket_received_city }}</p>
                <p><strong>Country:</strong> {{ $task->ticket->ticket_received_country }}</p>
                <p><strong>Accident:</strong> {{ $task->ticket->accident }}</p>
                <p><strong>Accident Description:</strong> {{ $task->ticket->accident_description }}</p>
                <p><strong>CDL License:</strong> {{ $task->ticket->cdl_license }}</p>
                <p><strong>Full Name:</strong> {{ $task->ticket->full_name }}</p>
                <p><strong>Email:</strong> {{ $task->ticket->email }}</p>
                <p><strong>Phone Number:</strong> {{ $task->ticket->phone_number }}</p>
                <p><strong>Response Deadline:</strong> {{ $task->ticket->response_deadline }}</p>
                <p><strong>Additional Details:</strong> {{ $task->ticket->additional_details }}</p>
            </div>
        </div>
    </div>
@endsection
