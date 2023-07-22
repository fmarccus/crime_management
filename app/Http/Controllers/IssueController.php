<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Issue;
use App\Models\Police;
use App\Models\Complainant;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        if (auth()->user()->user_type == 1) {
            $issues = Issue::where('user_id', auth()->user()->id)->get();
        } else {
            $issues = Issue::all();
        }
        return view('issues.index', compact('issues'));
    }
    public function view($id)
    {
        $issue = Issue::findOrFail($id);
        return view('issues.view', compact('issue'));
    }
    public function create()
    {
        $officers = User::where('user_type', '!=', 0)->get();
        $complainants = Complainant::all();
        return view('issues.create', compact('officers', 'complainants'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'complainant_id' => 'nullable|exists:complainants,id',
            'issue' => 'required|max:15000',
            'date' => 'required',
            'type' => 'required',
            'severity' => 'required|in:Normal,Severe,Critical'
        ]);
        $issue = new Issue();
        $issue->user_id = $request->user_id;
        $issue->complainant_id = $request->complainant_id;
        $issue->issue = $request->issue;
        $issue->date = $request->date;
        $issue->type = $request->type;

        $issue->severity = $request->severity;
        if ($request->user_id != NULL) {
            $issue->status = "Processing";
        }
        // dd($issue);
        $issue->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $officers = User::where('user_type', '!=', 0)->get();
        $complainants = Complainant::all();
        return view('issues.edit', compact('issue', 'officers', 'complainants'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'complainant_id' => 'nullable|exists:complainants,id',
            'issue' => 'required|max:15000',
            'date' => 'required',

            'type' => 'required',
            'severity' => 'required|in:Normal,Severe,Critical',
            'status' => 'required|in:Open,Processing,Completed'
        ]);
        $issue = Issue::findOrFail($id);
        $issue->user_id = $request->user_id;
        $issue->complainant_id = $request->complainant_id;
        $issue->issue = $request->issue;
        $issue->date = $request->date;

        $issue->type = $request->type;
        $issue->severity = $request->severity;
        $issue->status = $request->status;
        $issue->save();
        return back()->with('success', '');
    }

    public function delete($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return back()->with('deleted', '');
    }
}
