<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        EmailTemplate::create([
            'event' => 'New Driver',
            'subject' => 'Your Task has a new event stage',
            'body' => 'The event stage of task {task_name} has been changed to {event_stage}. Ticket ID: {ticket_id}'
        ]);
    }
}
