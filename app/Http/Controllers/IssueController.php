<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Issue;
use App\Models\Police;
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
        return view('issues.create', compact('officers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'complainant' => 'required|max:255',
            'phone' => 'required|min:11|max:11',
            'issue' => 'required|max:15000',
            'severity' => 'required|in:Normal,Severe,Critical'
        ]);
        $issue = new Issue();
        $issue->user_id = $request->user_id;
        $issue->complainant = $request->complainant;
        $issue->phone = $request->phone;
        $issue->issue = $request->issue;

        $issue->severity = $request->severity;
        $issue->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $officers = User::where('user_type', '!=', 0)->get();
        return view('issues.edit', compact('issue', 'officers'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'complainant' => 'required|max:255',
            'phone' => 'required|min:11|max:11',
            'issue' => 'required|max:15000',
            'severity' => 'required|in:Normal,Severe,Critical',
            'status' => 'required|in:Open,Processing,Completed'
        ]);
        $issue = Issue::findOrFail($id);
        $issue->user_id = $request->user_id;
        $issue->complainant = $request->complainant;
        $issue->phone = $request->phone;
        $issue->issue = $request->issue;
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
