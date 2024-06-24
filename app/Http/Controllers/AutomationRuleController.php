<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutomationRule;

class AutomationRuleController extends Controller
{
    public function index()
    {
        $rules = AutomationRule::paginate(10);
        return view('pages/automation_rules.index', compact('rules'));
    }

    public function create()
    {
        return view('pages/automation_rules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'trigger_event' => 'required|string',
            'action' => 'required|string',
            'email_subject' => 'nullable|string',
            'email_body' => 'nullable|string',
            'from_email' => 'nullable|email',
        ]);

        AutomationRule::create($request->all());

        return redirect()->route('automation_rules.index')->with('success', 'Automation Rule created successfully.');
    }

    public function edit(AutomationRule $automationRule)
    {
        return view('pages/automation_rules.edit', compact('automationRule'));
    }

    public function update(Request $request, AutomationRule $automationRule)
    {
        $request->validate([
            'trigger_event' => 'required|string',
            'action' => 'required|string',
            'email_subject' => 'required|string',
            'email_body' => 'required|string',
        ]);

        $automationRule->update($request->all());

        return redirect()->route('automation_rules.index')->with('success', 'Automation rule updated successfully.');
    }

    public function destroy(AutomationRule $automationRule)
    {
        $automationRule->delete();

        return redirect()->route('automation_rules.index')->with('success', 'Automation rule deleted successfully.');
    }
}
