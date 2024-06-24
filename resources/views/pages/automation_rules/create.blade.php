{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Automation Rule</h1>

        <form action="{{ route('automation_rules.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="trigger_event">Trigger Event</label>
                <input type="text" class="form-control" id="trigger_event" name="trigger_event" required>
            </div>

            <div class="form-group">
                <label for="action">Action</label>
                <input type="text" class="form-control" id="action" name="action" required>
            </div>

            <div class="form-group">
                <label for="email_subject">Email Subject</label>
                <input type="text" class="form-control" id="email_subject" name="email_subject">
            </div>

            <div class="form-group">
                <label for="email_body">Email Body</label>
                <textarea class="form-control" id="email_body" name="email_body"></textarea>
            </div>

            <div class="form-group">
                <label for="from_email">From Email</label>
                <input type="email" class="form-control" id="from_email" name="from_email">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection --}}


<!-- resources/views/automation_rules/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Automation Rule</h1>

        <form action="{{ route('automation_rules.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="trigger_event">Trigger Event</label>
                <select class="form-control" id="trigger_event" name="trigger_event" required>
                    <option value="">Select Trigger Event</option>
                    <option value="New Driver">New Driver</option>
                    <option value="Processed / Standby">Processed / Standby</option>
                    <option value="Assigned / Ready">Assigned / Ready</option>
                    <option value="Inactive / Unpaid">Inactive / Unpaid</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="action">Action</label>
                <select class="form-control" id="action" name="action" required>
                    <option value="">Select Action</option>
                    <option value="send_email">Send Email</option>
                </select>
            </div>

            <div class="email-fields" style="display: none;">
                <div class="form-group">
                    <label for="email_subject">Email Subject</label>
                    <input type="text" class="form-control" id="email_subject" name="email_subject" value="{{ old('email_subject') }}">
                </div>

                <div class="form-group">
                    <label for="email_body">Email Body</label>
                    <textarea class="form-control" id="email_body" name="email_body">{{ old('email_body') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="from_email">From Email</label>
                    <input type="email" class="form-control" id="from_email" name="from_email" value="{{ old('from_email') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

    <script>
        document.getElementById('action').addEventListener('change', function () {
            var emailFields = document.querySelector('.email-fields');
            if (this.value === 'send_email') {
                emailFields.style.display = 'block';
            } else {
                emailFields.style.display = 'none';
            }
        });
    </script>
@endsection
