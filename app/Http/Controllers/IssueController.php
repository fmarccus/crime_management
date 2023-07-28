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
        } elseif (auth()->user()->user_type == 2) {
            $issues = Issue::where('investigator_id', auth()->user()->id)->get();
        } elseif (auth()->user()->user_type == 3) {
            $issues = Issue::where('complainant_id', auth()->user()->id)->get();
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
        $officers = User::where('user_type', 1)->get();
        // $complainants = Complainant::all();
        $complainants = User::where('user_type', 3)->get();
        // $allComplainants = $complainants->merge($complainants2);
        $investigators = User::where('user_type', 2)->get();
        return view('issues.create', compact('officers', 'investigators', 'complainants'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'complainant_id' => 'nullable|exists:users,id',
            'investigator_id' => 'nullable|exists:users,id',
            'issue' => 'required|max:15000',
            'date' => 'required',
            'area' => 'required|in:Aguho,Magtanggol,Martires del 96,Poblacion,San Pedro,San Roque,Santa Ana,Santo Rosario Kanluran,Santo Rosario Silangan,Tabacalera',
            'type' => 'required',
            'severity' => 'required|in:Normal,Severe,Critical'
        ]);
        $issue = new Issue();
        $issue->user_id = $request->user_id;
        $issue->complainant_id = $request->complainant_id;
        $issue->investigator_id = $request->investigator_id;

        $issue->issue = $request->issue;
        $issue->date = $request->date;
        $issue->area = $request->area;

        $issue->type = $request->type;

        $issue->severity = $request->severity;
        if ($request->user_id != NULL) {
            $issue->status = "Processing";
        }
        // dd($issue);
        if ($request->status != "Completed") {
            $issue->updated_at = NULL;
        }
        $issue->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $officers = User::where('user_type', 1)->get();
        $complainants = User::where('user_type', 3)->get();

        $investigators = User::where('user_type', 2)->get();

        return view('issues.edit', compact('issue', 'officers', 'complainants', 'investigators'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'complainant_id' => 'nullable|exists:users,id',
            'investigator_id' => 'nullable|exists:users,id',
            'issue' => 'required|max:15000',
            'date' => 'required',
            'area' => 'required|in:Aguho,Magtanggol,Martires del 96,Poblacion,San Pedro,San Roque,Santa Ana,Santo Rosario Kanluran,Santo Rosario Silangan,Tabacalera',
            'type' => 'required',
            'severity' => 'required|in:Normal,Severe,Critical',
            'status' => 'required|in:Open,Processing,Completed'
        ]);
        $issue = Issue::findOrFail($id);
        $issue->user_id = $request->user_id;
        $issue->complainant_id = $request->complainant_id;
        $issue->investigator_id = $request->investigator_id;

        $issue->issue = $request->issue;
        $issue->date = $request->date;
        $issue->area = $request->area;
        $issue->type = $request->type;
        $issue->severity = $request->severity;
        $issue->status = $request->status;
        if ($request->status == "Completed") {
            $issue->updated_at = now();
        }
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
