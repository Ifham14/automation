{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Automation Rules</h1>
        <a href="{{ route('automation_rules.create') }}" class="btn btn-primary">Create Automation Rule</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Trigger Event</th>
                    <th>Action</th>
                    <th>Email Subject</th>
                    <th>Email Body</th>
                    <th>From Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rules as $rule)
                    <tr>
                        <td>{{ $rule->id }}</td>
                        <td>{{ $rule->trigger_event }}</td>
                        <td>{{ $rule->action }}</td>
                        <td>{{ $rule->email_subject }}</td>
                        <td>{{ $rule->email_body }}</td>
                        <td>{{ $rule->from_email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Automation Rules</h1>
    <a href="{{ route('automation_rules.create') }}" class="btn btn-primary mb-3">Create Automation Rule</a>
    <table class="table">
        <thead>
            <tr>
                <th>When</th>
                <th>Then</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rules as $rule)
                <tr>
                    <td>{{ $rule->trigger_event }}</td>
                    <td>{{ $rule->action }}</td>
                    <td>
                        <a href="{{ route('automation_rules.edit', $rule->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('automation_rules.destroy', $rule->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this rule?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {!! $rules->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection
