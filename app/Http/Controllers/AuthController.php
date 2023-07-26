<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'gender' => 'required|in:M,F',
            'phone' => 'required|min:11|max:11',
            'user_type' => 'integer|in:0,1,2,3',
            'rank' => 'required|in:n/a,Police General,Police Lieutenant General,Police Major General,Police Brigadier General,Police Colonel,Police Lieutenant Colonel,Police Major,Police Captain,Police Lieutenant,Police Executive Master Sergeant,Police Chief Master Sergeant,Police Senior Master Sergeant,Police Master Sergeant,Police Staff Sergeant,Police Corporal,Patrolman/Patrolwoman',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:8|max:55|confirmed'
        ]);
        $user = new User();
        if ($request->has('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $user->photo = $imageName;
        } else {
            $user->photo = NULL;
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->rank = $request->rank;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', '');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'gender' => 'required|in:M,F',
            'phone' => 'required|min:11|max:11',
            'user_type' => 'integer|in:0,1,2,3',
            'rank' => 'required|in:n/a,Police General,Police Lieutenant General,Police Major General,Police Brigadier General,Police Colonel,Police Lieutenant Colonel,Police Major,Police Captain,Police Lieutenant,Police Executive Master Sergeant,Police Chief Master Sergeant,Police Senior Master Sergeant,Police Master Sergeant,Police Staff Sergeant,Police Corporal,Patrolman/Patrolwoman',
            'email' => 'required|max:255|email|unique:users,email,' . $user->id,
            'password' => 'required|min:8|max:55|confirmed'
        ]);
        if ($request->has('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $user->photo = $imageName;
        } else {
            $user->photo = NULL;
        }
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->rank = $request->rank;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', '');
    }
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            $confirmation = "deleted";
        } catch (Exception $e) {
            $confirmation = "unable";
        }
        return back()->with($confirmation, '');
    }
}
