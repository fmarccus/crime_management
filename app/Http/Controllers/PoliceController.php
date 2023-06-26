<?php

namespace App\Http\Controllers;

use App\Models\Police;
use Illuminate\Http\Request;

class PoliceController extends Controller
{
    public function index()
    {
        $police_officers = Police::all();
        return view('police.index', compact('police_officers'));
    }
    public function create()
    {
        return view('police.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|max:255|email',
            'gender' => 'required|in:M,F',
            'phone' => 'required|min:11|max:11',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $police = new Police();
        $police->name = $request->name;
        $police->surname = $request->surname;
        $police->email = $request->email;
        $police->gender = $request->gender;
        $police->phone = $request->phone;
        $imageName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('images'), $imageName);
        $police->photo = $imageName;
        $police->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $police = Police::findOrFail($id);
        return view('police.edit', compact('police'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|max:255|email',
            'gender' => 'required|in:M,F',
            'phone' => 'required|min:11|max:11',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $police = Police::findOrFail($id);
        $police->name = $request->name;
        $police->surname = $request->surname;
        $police->email = $request->email;
        $police->gender = $request->gender;
        $police->phone = $request->phone;
        $imageName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('images'), $imageName);
        $police->photo = $imageName;
        $police->save();
        return back()->with('success', '');
    }
    public function delete($id)
    {
        $police = Police::findOrFail($id);
        $police->delete();
        return back()->with('deleted', '');
    }
}
