<!-- resources/views/task/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="event_stage">Event Stage</label>
                <select class="form-control" id="event_stage" name="event_stage" required>
                    <option value="New Driver" {{ $task->event_stage == 'New Driver' ? 'selected' : '' }}>New Driver</option>
                    <option value="Processed / Standby" {{ $task->event_stage == 'Processed / Standby' ? 'selected' : '' }}>Processed / Standby</option>
                    <option value="Assigned / Ready" {{ $task->event_stage == 'Assigned / Ready' ? 'selected' : '' }}>Assigned / Ready</option>
                    <option value="Inactive / Unpaid" {{ $task->event_stage == 'Inactive / Unpaid' ? 'selected' : '' }}>Inactive / Unpaid</option>
                    <option value="Completed" {{ $task->event_stage == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
