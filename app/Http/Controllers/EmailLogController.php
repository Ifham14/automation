<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailLog;

class EmailLogController extends Controller
{
    public function index()
    {
        $emailLogs = EmailLog::all();
        return view('pages/email_logs.index', compact('emailLogs'));
    }
}
