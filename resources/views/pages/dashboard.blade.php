@extends('layouts.app')

@section('content')
    <div class="jumbotron container">
        <h1 class="display-4">Dashboard!</h1>
        <p class="lead">You are logged in.</p>

        <form id="multi-step-form" method="POST" action="{{ route('ticket.submit') }}">
            @csrf
            <div id="step-1" class="step">
                <h3>Tell us where you are from</h3>
                <div class="form-group">
                    <label for="state">Select State</label>
                    <select id="state" name="state" class="form-control">
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary mt-3" id="next-step-1">Next</button>
            </div>

            <div id="step-2" class="step" style="display: none;">
                <h3>Fight and dispute your ticket 100% online. 100% Secure Win It or It's Free Guaranteed.</h3>
                <div class="form-group">
                    <label for="options1">Select the violations that appear on your Ticket(s)</label>
                    <div id="custom-multi-select-1" class="custom-multi-select form-control" data-option-set="options1"></div>
                </div>
                <div class="form-group">
                    <label for="ticket_date">When were your ticket(s) issued?</label>
                    <input type="text" id="ticketDate" name="ticket_date" class="form-control" placeholder="Select Date">
                    <div class="input-group-append">
                        <input class="form-check-input" name="remember_ticket_receive"  type="checkbox" for id="rememberDate">
                        <label class="form-check-label" for="remember_ticket_receive">I do not remember the date I received my ticket(s)</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ticket_type">Do you know how many points you are facing?</label>
                    <div>
                        <label><input type="radio" name="ticket_type" value="1" id="yesTicketType"> Yes</label>
                        <label><input type="radio" name="ticket_type" value="2" id="noTicketType"> No</label>
                    </div>
                </div>
                <div id="ticketPointsGroup" class="form-group" style="display: none;">
                    <label for="ticket_points">How many points are you facing?</label>
                    <input type="text" id="ticketPoints" name="ticket_points" class="form-control">
                </div>
                <button type="button" class="btn btn-secondary mt-3" id="prev-step-2">Previous</button>
                <button type="button" class="btn btn-primary mt-3" id="next-step-2">Next</button>
            </div>

            <div id="step-3" class="step" style="display: none;">
                <h3>We need some more information.</h3>
                <div class="form-group">
                    <label for="existing_points">Do you know how many existing points you have currently on your license?</label>
                    <div>
                        <label><input type="radio" name="existing_points" value="yes" id="yesExistingPoints"> Yes</label>
                        <label><input type="radio" name="existing_points" value="no" id="noExistingPoints"> No</label>
                    </div>
                </div>
                <div id="existingPointsGroup" class="form-group" style="display: none;">
                    <label for="existing_points_count">How many points do you have?</label>
                    <input type="number" id="existingPointsCount" name="existing_points_count" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ticketLocation">Where did you receive your ticket(s)?</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="city" name="ticket_received_city" class="form-control" placeholder="City">
                        </div>
                        <div class="col">
                            <input type="text" id="country" name="ticket_received_country" class="form-control" placeholder="Country">
                        </div>
                        <div class="col">
                            <select id="state" name="ticket_received_state" class="form-control">
                                <option value="">Select State</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="accident">Was there an accident involved?</label>
                    <div>
                        <label><input type="radio" name="accident" value="yes" id="yesAccident"> Yes</label>
                        <label><input type="radio" name="accident" value="no" id="noAccident"> No</label>
                    </div>
                </div>
                <div id="accidentDetails" class="form-group" style="display: none;">
                    <label for="accident_description">Accident Details</label>
                    <textarea id="accidentDescription" name="accident_description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="cdl_license">Do you have a commercial (CDL) license?</label>
                    <div>
                        <label><input type="radio" name="cdl_license" value="yes" id="yesCDL"> Yes</label>
                        <label><input type="radio" name="cdl_license" value="no" id="noCDL"> No</label>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary mt-3" id="prev-step-3">Previous</button>
                <button type="button" class="btn btn-primary mt-3" id="next-step-4">Next</button>
            </div>

            <div id="step-4" class="step" style="display: none;">
                <h2>We need some information about you.</h2>
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="fullName" name="full_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="tel" id="phoneNumber" name="phone_number" class="form-control" required>
                </div>
                <button type="button" class="btn btn-secondary mt-3" id="prev-step-4">Previous</button>
                <button type="button" class="btn btn-primary mt-3" id="next-step-5">Next</button>
            </div>

            <div id="step-5" class="step" style="display: none;">
                <h3>We need additional ticket information.</h3>
                <div class="form-group">
                    <label for="ticket_ids">Please enter your Ticket ID(s) / Ticket Number(s) below</label>
                    <input type="text" id="ticketIDs" name="ticket_ids" class="form-control" required>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="unknownTicketIDs">
                        <label class="form-check-label" for="unknownTicketIDs">I do not know my Ticket ID(s) / Ticket Number(s).</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="response_deadline">When is your response deadline or your hearing date?</label>
                    <input type="date" id="responseDeadline" name="response_deadline" class="form-control" required>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="unknownDeadline">
                        <label class="form-check-label" for="unknownDeadline">I do not know.</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="additional_details">Enter more important details below that you think your Attorney should know, if any.</label>
                    <textarea id="additionalDetails" name="additional_details" class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-secondary mt-3" id="prev-step-5">Previous</button>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#ticketDate').datepicker();

        $('.custom-multi-select').each(function() {
            const optionSet = $(this).data('option-set');
            new window.MultiSelect(this, optionSet);
        });

        $('#next-step-1').click(function() {
            $('#step-1').hide();
            $('#step-2').show();
        });
        $('#next-step-2').click(function() {
            $('#step-2').hide();
            $('#step-3').show();
        });
        $('#next-step-4').click(function() {
            $('#step-3').hide();
            $('#step-4').show();
        });
        $('#next-step-5').click(function() {
            $('#step-4').hide();
            $('#step-5').show();
        });

        $('#prev-step-2').click(function() {
            $('#step-2').hide();
            $('#step-1').show();
        });
        $('#prev-step-3').click(function() {
            $('#step-3').hide();
            $('#step-2').show();
        });
        $('#prev-step-4').click(function() {
            $('#step-4').hide();
            $('#step-3').show();
        });
        $('#prev-step-5').click(function() {
            $('#step-5').hide();
            $('#step-4').show();
        });

        $('#yesTicketType').change(function() {
            if ($(this).is(':checked')) {
                $('#ticketPointsGroup').show();
            }
        });

        $('#noTicketType').change(function() {
            if ($(this).is(':checked')) {
                $('#ticketPointsGroup').hide();
            }
        });

        $('#yesExistingPoints').change(function() {
            if ($(this).is(':checked')) {
                $('#existingPointsGroup').show();
            }
        });

        $('#noExistingPoints').change(function() {
            if ($(this).is(':checked')) {
                $('#existingPointsGroup').hide();
            }
        });

        $('#yesAccident').change(function() {
            if ($(this).is(':checked')) {
                $('#accidentDetails').show();
            }
        });

        $('#noAccident').change(function() {
            if ($(this).is(':checked')) {
                $('#accidentDetails').hide();
            }
        });


    });
</script>
@endsection
