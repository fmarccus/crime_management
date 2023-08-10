<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    public function getWitnesses()
    {
        $people = Person::with('issue')->where('person_type', 'witness')->get();
        return view('people.witnesses', compact('people'));
    }
    public function getSuspects()
    {
        $people = Person::with('issue')->where('person_type', 'suspect')->get();
        return view('people.suspects', compact('people'));
    }
    public function view($id)
    {
        $person = Person::findOrFail($id);
        return response()->json([
            'person' => $person
        ]);
    }
}
