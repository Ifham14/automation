<?php

namespace App\Observers;

use App\Models\Task;
use App\Events\EventStageChanged;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    // public function created(Task $task) : void
    // {
    //     Log::info('In TaskObserver created method');
    //     if ($task->event_stage === 'New Driver') {
    //         Log::info('Dispatching EventStageChanged event for task: ', ['task' => $task]);
    //         event(new EventStageChanged($task));
    //     }
    // }
}
