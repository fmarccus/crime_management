<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Police;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::all();
        return view('issues.index', compact('issues'));
    }
    public function create()
    {
        $officers = Police::all();
        return view('issues.create', compact('officers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'officer_id' => 'required|exists:police,id',
            'complainant' => 'required|max:255',
            'phone' => 'required|min:11|max:11',
            'issue' => 'required|max:15000',
            'severity' => 'required|in:Normal,Severe,Critical'
        ]);
        $issue = new Issue();
        $issue->officer_id = $request->officer_id;
        $issue->complainant = $request->complainant;
        $issue->phone = $request->phone;
        $issue->severity = $request->severity;
        $issue->save();
        return back()->with('success', '');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'officer_id' => 'required|exists:police,id',
            'complainant' => 'required|max:255',
            'phone' => 'required|min:11|max:11',
            'issue' => 'required|max:15000',
            'severity' => 'required|in:Normal,Severe,Critical',
            'status' => 'required|in:Open,Processing,Completed'
        ]);
        $issue = Issue::findOrFail($id);
        $issue->officer_id = $request->officer_id;
        $issue->complainant = $request->complainant;
        $issue->phone = $request->phone;
        $issue->severity = $request->severity;
        $issue->status = $request->status;
        $issue->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $issue = Issue::findOrFail($id)->with('police')->get();
        return view('issues.edit', compact('issue'));
    }
}
