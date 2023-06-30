<?php

namespace App\Http\Controllers;

use App\Models\Complainant;
use Exception;
use Illuminate\Http\Request;

class ComplainantController extends Controller
{
    public function index()
    {
        $complainants = Complainant::all();
        return view('complainants.index', compact('complainants'));
    }
    public function create()
    {
        return view('complainants.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'middlename' => 'required|max:255',
            'surname' => 'required|max:255',
            'age' => 'required|numeric|between:1,100',
            'gender' => 'required|in:M,F',
            'phone' => 'required|min:11|max:11',
            'email' => 'required|max:255|email',
            'address' => 'required|max:2500',
        ]);
        $complainant = new Complainant();
        $complainant->name = $request->name;
        $complainant->middlename = $request->middlename;
        $complainant->surname = $request->surname;
        $complainant->age = $request->age;
        $complainant->gender = $request->gender;
        $complainant->phone = $request->phone;
        $complainant->email = $request->email;
        $complainant->address = $request->address;
        $complainant->save();
        return back()->with('success', '');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'middlename' => 'required|max:255',
            'surname' => 'required|max:255',
            'age' => 'required|numeric|between:1,100',
            'gender' => 'required|in:M,F',
            'phone' => 'required|min:11|max:11',
            'email' => 'required|max:255|email',
            'address' => 'required|max:2500',
        ]);
        $complainant = Complainant::findOrFail($id);
        $complainant->name = $request->name;
        $complainant->middlename = $request->middlename;
        $complainant->surname = $request->surname;
        $complainant->age = $request->age;
        $complainant->gender = $request->gender;
        $complainant->phone = $request->phone;
        $complainant->email = $request->email;
        $complainant->address = $request->address;
        $complainant->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $complainant = Complainant::findOrFail($id);
        return view('complainants.edit', compact('complainant'));
    }
    public function delete($id)
    {
        try {
            $complainant = Complainant::findOrFail($id);
            $complainant->delete();
            $confirmation = "deleted";
        } catch (Exception $e) {
            $confirmation = "unable";
        }
        return back()->with($confirmation, '');
    }
}
