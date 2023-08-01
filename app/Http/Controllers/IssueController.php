<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Issue;
use App\Models\Person;
use App\Models\Police;
use App\Models\Complainant;
use App\Models\Evidence;
use App\Models\Progress;
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
        $issue = Issue::where('complainant_id', auth()->user()->id)->findOrFail($id);
        $progresses = Progress::where('issue_id', $id)->orderByDesc('created_at')->get();
        $evidences = Evidence::where('issue_id', $id)->orderByDesc('created_at')->pluck('image');


        $itemsArray = $evidences->map(function ($item) {
            return json_decode($item, true) ?? [];
        })->toArray();

        $evidences = [];

        foreach ($itemsArray as $innerArray) {
            foreach ($innerArray as $file) {
                if (strpos($file, ".png") !== false) {
                    $evidences[] = $file;
                }
            }
        }
        return view('issues.view', compact('issue', 'progresses', 'evidences'));
    }
    public function create()
    {
        if (auth()->user()->user_type == 0 || auth()->user()->user_type == 3) {
            $officers = User::where('user_type', 1)->get();
            $complainants = User::where('user_type', 3)->get();
            $investigators = User::where('user_type', 2)->get();
            return view('issues.create', compact('officers', 'investigators', 'complainants'));
        } else {
            return redirect()->back();
        }
    }
    public function storeEvidence(Request $request, $id)
    {
        $request->validate([
            'imageFile.*' => 'mimes:jpeg,jpg,png,gif|max:10000'

        ]);
        if ($request->hasfile('imageFile')) {
            foreach ($request->file('imageFile') as $file) {
                $name = md5(rand(1000, 10000)) . '_' . $file->getClientOriginalName();
                $file->move(public_path('evidences'), $name);
                $imgData[] = $name;
            }
            $evidence = new Evidence();
            $evidence->issue_id = $id;
            $evidence->image = json_encode($imgData);
            $evidence->save();
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        if (auth()->user()->user_type == 0 || auth()->user()->user_type == 3) {
            $request->validate([
                'user_id' => 'nullable|exists:users,id',
                'complainant_id' => 'nullable|exists:users,id',
                'investigator_id' => 'nullable|exists:users,id',
                'issue' => 'required|max:15000',
                'date' => 'required',
                'area' => 'required|in:Aguho,Magtanggol,Martires del 96,Poblacion,San Pedro,San Roque,Santa Ana,Santo Rosario Kanluran,Santo Rosario Silangan,Tabacalera',
                'type' => 'required',
                'severity' => 'required|in:Normal,Severe,Critical',
                'imageFile.*' => 'mimes:jpeg,jpg,png,gif|max:10000'
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
            if ($request->status != "Completed") {
                $issue->updated_at = NULL;
            }
            if (auth()->user()->user_type == 3) {
                $issue->user_id = NULL;
                $issue->investigator_id = NULL;
                $issue->status = "Open";
                $issue->complainant_id = auth()->user()->id;
            }




            $issue->save();

            if ($request->hasfile('imageFile')) {
                foreach ($request->file('imageFile') as $file) {
                    $name = md5(rand(1000, 10000)) . '_' . $file->getClientOriginalName();
                    $file->move(public_path('evidences'), $name);
                    $imgData[] = $name;
                }
                $evidence = new Evidence();
                $evidence->issue_id = $issue->id;
                $evidence->image = json_encode($imgData);
                // dd($evidence);
                $evidence->save();
            }

            $personData = $request->input('person_data');

            foreach ($personData as $data) {
                $person = new Person();
                $person->issue_id = $issue->id;
                $person->person_name = $data['person_name'];
                $person->person_type = $data['person_type'];
                $person->gender = $data['gender'];
                $person->dob = $data['dob'];
                $person->address = $data['address'];
                $person->contact = $data['contact'];
                $person->height = $data['height'];
                $person->weight = $data['weight'];
                $person->hair = $data['hair'];
                $person->eye = $data['eye'];
                $person->ethnicity = $data['ethnicity'];
                $person->statement = $data['statement'];
                $person->save();
            }
            return back()->with('success', '');
        } else {
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $officers = User::where('user_type', 1)->get();
        $complainants = User::where('user_type', 3)->get();
        $investigators = User::where('user_type', 2)->get();
        $progresses = Progress::where('issue_id', $id)->orderByDesc('created_at')->get();
        $evidences = Evidence::where('issue_id', $id)->orderByDesc('created_at')->pluck('image');
        // Assuming $items is the array retrieved from the database, which contains Laravel Collections
        $itemsArray = $evidences->map(function ($item) {
            return json_decode($item, true) ?? [];
        })->toArray();

        $evidences = [];

        foreach ($itemsArray as $innerArray) {
            foreach ($innerArray as $file) {
                if (strpos($file, ".png") !== false) {
                    $evidences[] = $file;
                }
            }
        }

        // Now $pngFiles contains all the PNG files from the Laravel array.

        return view('issues.edit', compact('issue', 'officers', 'complainants', 'investigators', 'progresses', 'evidences'));
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
        $personData = $request->input('person_data');
        foreach ($personData as $data) {
            $person = Person::findOrFail($data['personId']);
            $person->person_name = $data['person_name'];
            $person->person_type = $data['person_type'];
            $person->gender = $data['gender'];
            $person->dob = $data['dob'];
            $person->address = $data['address'];
            $person->contact = $data['contact'];
            $person->height = $data['height'];
            $person->weight = $data['weight'];
            $person->hair = $data['hair'];
            $person->eye = $data['eye'];
            $person->ethnicity = $data['ethnicity'];
            $person->statement = $data['statement'];
            if ($request->has('identification')) {
                $imageName = time() . $data['person_name'] . '' . '.' . $request->identification->extension();
                $request->photo->move(public_path('people'), $imageName);
                $person->identification = $imageName;
            }
            $person->save();
        }
        return back()->with('success', '');
    }

    public function delete($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return back()->with('deleted', '');
    }
    public function storeProgress(Request $request, $id)
    {
        $request->validate([
            'issue_id' => 'nullable|exists:issues,id',
            'subject' => 'required|max:255',
            'note' => 'required|max:15000',
        ]);
        $progress = new Progress();
        $progress->issue_id = $id;
        $progress->subject = $request->subject;
        $progress->note = $request->note;
        $progress->save();
        return back()->with('progress', '');
    }
}
