<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Ticket\TicketController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\EmailLogController;
use App\Http\Controllers\AutomationRuleController;
use App\Events\EventStageChanged;
use App\Models\Task;

// Public routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('redirect.if.authenticated');
Route::post('login', [AuthController::class, 'login'])->middleware('redirect.if.authenticated');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('redirect.if.authenticated');
Route::post('register', [AuthController::class, 'register'])->middleware('redirect.if.authenticated');

Route::post('/ticket-data', [TicketController::class, 'handleFormSubmission']);
Route::get('/csrf-token', function() { return response()->json(['csrfToken' => csrf_token()]); });

// Protected routes
Route::middleware(['jwt'])->group(function () {
    Route::get('/', function () {
        return view('pages/dashboard');
    })->name('dashboard');

    /* Auth Start */
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('user', [AuthController::class, 'getUser'])->name('user');
    /* Auth End */

    /* Ticket Start */
    Route::post('ticket/create', [TicketController::class, 'store'])->name('ticket.submit');
    /* Ticket End */

    /* Task Start */
    Route::resource('tasks', TaskController::class);
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    /* Task End */

    /* Email Log Start */
    Route::get('/email-logs', [EmailLogController::class, 'index'])->name('email-logs.index');
    /* Email Log Start */

    Route::resource('automation_rules', AutomationRuleController::class);

    Route::get('/test-event', function () {
        $task = Task::find(1); // Assume there's a task with ID 1
        event(new EventStageChanged($task));
        return 'Event dispatched!';
    });

});
