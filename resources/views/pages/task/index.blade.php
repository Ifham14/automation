@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Event Stage</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->ticket->full_name }}</td>
                        <td>{{ $task->ticket->email }}</td>
                        <td>{{ $task->ticket->phone_number }}</td>
                        <td>{{ $task->event_stage }}</td>
                        <td>{{ $task->status }}</td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary">View Details</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-secondary">Edit</a>
                        </td>
                        {{-- <td><a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary">View Details</a></td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {!! $tasks->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection
