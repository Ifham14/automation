{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Automation Rule</h1>
    <form action="{{ route('automation_rules.update', $automationRule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="trigger_event">When</label>
            <select class="form-control" id="trigger_event" name="trigger_event" required>
                <option value="ticket_created" {{ $automationRule->trigger_event == 'ticket_created' ? 'selected' : '' }}>Ticket Created</option>
                <!-- Add other events as needed -->
            </select>
        </div>

        <div class="form-group">
            <label for="action">Then</label>
            <select class="form-control" id="action" name="action" required>
                <option value="send_email" {{ $automationRule->action == 'send_email' ? 'selected' : '' }}>Send Email</option>
                <!-- Add other actions as needed -->
            </select>
        </div>

        <div class="form-group">
            <label for="email_subject">Email Subject</label>
            <input type="text" class="form-control" id="email_subject" name="email_subject" value="{{ $automationRule->email_subject }}" required>
        </div>

        <div class="form-group">
            <label for="email_body">Email Body</label>
            <textarea class="form-control" id="email_body" name="email_body" rows="5" required>{{ $automationRule->email_body }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Rule</button>
        <a href="{{ route('automation_rules.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection --}}


<!-- resources/views/automation_rules/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Automation Rule</h1>

        <form action="{{ route('automation_rules.update', $automationRule->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="trigger_event">Trigger Event</label>
                <select class="form-control" id="trigger_event" name="trigger_event" required>
                    <option value="">Select Trigger Event</option>
                    <option value="New Driver" {{ $automationRule->trigger_event == 'New Driver' ? 'selected' : '' }}>New Driver</option>
                    <option value="Processed / Standby" {{ $automationRule->trigger_event == 'Processed / Standby' ? 'selected' : '' }}>Processed / Standby</option>
                    <option value="Assigned / Ready" {{ $automationRule->trigger_event == 'Assigned / Ready' ? 'selected' : '' }}>Assigned / Ready</option>
                    <option value="Inactive / Unpaid" {{ $automationRule->trigger_event == 'Inactive / Unpaid' ? 'selected' : '' }}>Inactive / Unpaid</option>
                    <option value="Completed" {{ $automationRule->trigger_event == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="action">Action</label>
                <select class="form-control" id="action" name="action" required>
                    <option value="">Select Action</option>
                    <option value="send_email" {{ $automationRule->action == 'send_email' ? 'selected' : '' }}>Send Email</option>
                </select>
            </div>

            <div class="email-fields" style="{{ $automationRule->action == 'send_email' ? 'display: block;' : 'display: none;' }}">
                <div class="form-group">
                    <label for="email_subject">Email Subject</label>
                    <input type="text" class="form-control" id="email_subject" name="email_subject" value="{{ old('email_subject', $automationRule->email_subject) }}">
                </div>

                <div class="form-group">
                    <label for="email_body">Email Body</label>
                    <textarea class="form-control" id="email_body" name="email_body">{{ old('email_body', $automationRule->email_body) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="from_email">From Email</label>
                    <input type="email" class="form-control" id="from_email" name="from_email" value="{{ old('from_email', $automationRule->from_email) }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
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
