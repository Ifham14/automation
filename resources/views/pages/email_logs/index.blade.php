// resources/views/pages/email_logs/index.blade.php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Email Logs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Recipient</th>
                <th>Subject</th>
                <th>Body</th>
                <th>Sent At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emailLogs as $emailLog)
                <tr>
                    <td>{{ $emailLog->id }}</td>
                    <td>{{ $emailLog->recipient }}</td>
                    <td>{{ $emailLog->subject }}</td>
                    <td>{{ $emailLog->body }}</td>
                    <td>{{ $emailLog->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
