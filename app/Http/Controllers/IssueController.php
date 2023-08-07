<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueStoreRequest;
use App\Http\Requests\IssueUpdateRequest;
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
            $issues = Issue::with(['investigator', 'complainant', 'user'])->where('user_id', auth()->user()->id)->get();
        } elseif (auth()->user()->user_type == 2) {
            $issues = Issue::with(['investigator', 'complainant', 'user'])->where('investigator_id', auth()->user()->id)->get();
        } elseif (auth()->user()->user_type == 3) {
            $issues = Issue::with(['investigator', 'complainant', 'user'])->where('complainant_id', auth()->user()->id)->get();
        } else {
            $issues = Issue::with(['investigator', 'complainant', 'user'])->get();
        }
        return view('issues.index', compact('issues'));
    }
    public function view($id)
    {
        if (auth()->user()->user_type == 0) {
            $issue = Issue::where('user_id', auth()->user()->id)->findOrFail($id);
        } elseif (auth()->user()->user_type == 1) {
            $issue = Issue::where('user_id', auth()->user()->id)->findOrFail($id);
        } elseif (auth()->user()->user_type == 2) {
            $issue = Issue::where('investigator_id', auth()->user()->id)->findOrFail($id);
        } else {
            $issue = Issue::where('complainant_id', auth()->user()->id)->findOrFail($id);
        }



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
            'imageFile' => 'required',
            'imageFile.*' => 'required|mimes:jpeg,JPEG,jpg,JPG,png,PNG,gif,GIF,svg,SVG,webp|max:10000'
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
            return back()->with('evidence', '');
        }
    }
    public function store(IssueStoreRequest $request)
    {
        if (auth()->user()->user_type == 0 || auth()->user()->user_type == 3) {
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
    public function update(IssueUpdateRequest $request, $id)
    {
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
        if (auth()->user()->user_type != 3) {
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
        } else {
            return redirect()->back();
        }
    }
    public function storePerson(Request $request, $id)
    {
        if (auth()->user()->user_type != 3) {
            $personData = $request->input('person_data');
            foreach ($personData as $data) {
                $person = new Person();
                $person->issue_id = $id;
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
                return back()->with('person', '');
            }
        } else {
            return redirect()->back();
        }
    }
}
