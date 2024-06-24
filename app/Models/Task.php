<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\EventStageChanged;
use Illuminate\Support\Facades\Log;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id', 'event_stage', 'status', 'start_date', 'end_date', 'quote'
    ];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::updated(function ($task) {
    //         if ($task->isDirty('event_stage')) {
    //             event(new EventStageChanged($task));
    //         }
    //     });

    //     static::created(function ($task) {
    //         if ($task->event_stage === 'New Driver') {
    //             \Log::info('Dispatching EventStageChanged event for task: ', ['task' => $task]);
    //             event(new EventStageChanged($task));
    //         }
    //     });
    // }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

}
