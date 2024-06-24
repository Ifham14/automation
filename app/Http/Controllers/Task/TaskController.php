<?php

namespace App\Http\Controllers\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\EventStageChanged;
use Illuminate\Support\Facades\Log;
use App\Models\AutomationRule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('ticket')->orderBy('created_at', 'desc')->paginate(10);
        return view('pages/task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'event_stage' => 'nullable|string',
            'status' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'quote' => 'nullable|string',
        ]);

        Task::create($validatedData);

        return redirect()->route('pages/task.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::with('ticket')->findOrFail($id);
        return view('/pages/task.show', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Task $task)
    // {
    //     $validatedData = $request->validate([
    //         'ticket_id' => 'required|exists:tickets,id',
    //         'event_stage' => 'nullable|string',
    //         'status' => 'nullable|string',
    //         'start_date' => 'nullable|date',
    //         'end_date' => 'nullable|date',
    //         'quote' => 'nullable|string',
    //     ]);

    //     $task->update($validatedData);

    //     return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    // }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $oldEventStage = $task->event_stage;
        $task->update($request->all());

        if ($oldEventStage !== $task->event_stage) {
            event(new EventStageChanged($task));
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('pages/task.edit', compact('task'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
