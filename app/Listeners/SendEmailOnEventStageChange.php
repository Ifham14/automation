<?php

namespace App\Listeners;

use App\Events\EventStageChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailLog;
use App\Models\Ticket;
use App\Models\AutomationRule;
use Illuminate\Support\Facades\Log;

class SendEmailOnEventStageChange
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        \Log::info('SendEmailOnEventStageChange listener instantiated');
    }

    /**
     * Handle the event.
     */
    // public function handle(EventStageChanged $event)
    // {
    //     $task = $event->task;
    //     $ticket = Ticket::find($task->ticket_id);

    //     \Log::info('in SendEmailOnEventStageChange');

    //     if ($task->event_stage === 'New Driver') {
    //         $emailBody = "The event stage of task {$task->name} has been changed to 'New Driver'.";

    //         // Log email sending attempt
    //         \Log::info('Attempting to send email for task: ', ['task' => $task, 'ticket' => $ticket]);

    //         // Send email to the ticket creator
    //         Mail::raw($emailBody, function ($message) use ($ticket) {
    //             $message->to($ticket->email)
    //                     ->subject('Task Event Stage Changed');
    //         });

    //         // Log email success
    //         \Log::info('Email sent for task: ', ['task' => $task, 'ticket' => $ticket]);

    //         // Save email log
    //         EmailLog::create([
    //             'recipient' => $ticket->email,
    //             'subject' => 'Task Event Stage Changed',
    //             'body' => $emailBody
    //         ]);
    //     }
    // }

    public function handle(EventStageChanged $event)
    {
        $task = $event->task;
        $rule = AutomationRule::where('trigger_event', $task->event_stage)->first();

        if ($rule && $rule->action == 'send_email') {
            Mail::raw($rule->email_body, function ($message) use ($rule, $task) {
                $message->to($task->ticket->email)
                    ->subject($rule->email_subject)
                    ->from($rule->from_email);
            });
        }
    }
}
