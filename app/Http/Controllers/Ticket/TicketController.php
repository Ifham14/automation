<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Task;
use App\Models\EmailLog;
use App\Models\EmailTemplate;
use App\Models\AutomationRule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{


    public function handleFormSubmission(Request $request)
    {
        \Log::info('Form Data Here of ticket:', $request->all());

        // Organize and format the data
        $formattedData = $this->formatFormData($request);

        // Call the store function with the formatted data
        return $this->store(new Request($formattedData));
        // Return a response
        // return response()->json(['success' => true, 'message' => 'Form submitted successfully!']);
    }
        // Format form data to match the expected structure for the store method
    private function formatFormData($request)
    {
        $formattedDate = $request->input('ticketdate') ? date('Y-m-d', strtotime($request->input('ticketdate'))) : null;
        $responseDeadline = $request->input('responsedeadline') ? date('Y-m-d', strtotime($request->input('responsedeadline'))) : null;

        return [
            'state' => $request->input('state'),
            'ticket_date' => $formattedDate,
            // 'ticket_type' => implode(', ', (array) $request->input('violationsticket')),
            // 'ticket_points' => $request->input('ticketpoints'),
            // 'existing_points' => $request->input('facingprobleminpoints'),
            // 'existing_points_count' => $request->input('points_quantity_input'),
            'ticket_received_city' => $request->input('city'),
            'ticket_received_country' => $request->input('county'),
            'ticket_received_state' => $request->input('state'),
            'accident' => $request->input('accident'),
            'accident_description' => $request->input('accidentstory'),
            'cdl_license' => $request->input('vehicle-type'),
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone'),
            'ticket_ids' => $request->input('ticketidno'),
            'response_deadline' => $responseDeadline,
            'additional_details' => $request->input('full_comments'),
        ];
    }
    public function store(Request $request)
    {
        \Log::info('Form data received:', $request->all());
        try {
            $formattedDate = date('Y-m-d', strtotime($request->input('ticket_date')));

            $validatedData = $request->validate([
                'state' => 'nullable',
                'ticket_date' => 'nullable|date',
                'ticket_type' => 'nullable',
                'ticket_points' => 'nullable|string',
                'existing_points' => 'nullable|string',
                'existing_points_count' => 'nullable|string',
                'ticket_received_city' => 'nullable|string',
                'ticket_received_country' => 'nullable|string',
                'ticket_received_state' => 'nullable|string',
                'accident' => 'nullable|string',
                'accident_description' => 'nullable|string',
                'cdl_license' => 'nullable|string',
                'full_name' => 'nullable|string',
                'email' => 'nullable|email',
                'phone_number' => 'nullable|string',
                'ticket_ids' => 'nullable|string',
                'response_deadline' => 'nullable|date',
                'additional_details' => 'nullable|string',
            ]);
            $validatedData['ticket_date'] = $formattedDate;
            // Save the form data to the database
            $ticket = Ticket::create($validatedData);

            // Create a task for the ticket
            $task = Task::create([
                'ticket_id' => $ticket->id,
                'event_stage' => 'New Driver',
                'status' => 'Todo',
            ]);

            // // Fetch the email template for the 'New Driver' event
            // $emailTemplate = EmailTemplate::where('event', 'New Driver')->first();

            // if ($emailTemplate) {
            //     $emailBody = $emailTemplate->body;
            //     $emailSubject = $emailTemplate->subject;

            //     // Replace placeholders with actual values
            //     $emailBody = str_replace(['{task_name}', '{event_stage}', '{ticket_id}'], [$task->id, $task->event_stage, $ticket->id], $emailBody);

            //     // Send email notification to the user
            //     $userEmail = $request->input('email'); // Assuming email is part of form data
            //     Mail::raw($emailBody, function ($message) use ($userEmail, $emailSubject) {
            //         $message->to($userEmail)->subject($emailSubject);
            //     });

            //     // Save email log
            //     EmailLog::create([
            //         'recipient' => $userEmail,
            //         'subject' => $emailSubject,
            //         'body' => $emailBody,
            //     ]);
            // }

            // Check for automation rules
            $automationRule = AutomationRule::where('trigger_event', 'New Driver')->first();
            if ($automationRule && $automationRule->action === 'send_email') {
                $emailBody = str_replace(['{task_id}', '{event_stage}'], [$task->id, $task->event_stage], $automationRule->email_body);
                $emailSubject = $automationRule->email_subject;
                $fromEmail = $automationRule->from_email;

                Mail::raw($emailBody, function ($message) use ($ticket, $emailSubject, $fromEmail) {
                    $message->to($ticket->email)
                            ->subject($emailSubject);
                    if ($fromEmail) {
                        $message->from($fromEmail);
                    }
                });

                // Save email log
                EmailLog::create([
                    'recipient' => $ticket->email,
                    'subject' => $emailSubject,
                    'body' => $emailBody,
                ]);
            }

            setAlert('success', 'Ticket created!');

            // Redirect the user after successful submission
            return redirect()->route('dashboard')->with('success', 'Form submitted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error storing form data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}
