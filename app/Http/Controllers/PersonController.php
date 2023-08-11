<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    public function getWitnesses()
    {
        $people = Issue::with(['persons' => function ($query) {
            $query->where('person_type', 'witness');
        }])
            ->where($this->getUserType(), $this->getUserId())
            ->get()
            ->pluck('persons')
            ->flatten();
        return view('people.witnesses', compact('people'));
    }
    public function getSuspects()
    {
        $people = Issue::with(['persons' => function ($query) {
            $query->where('person_type', 'suspect');
        }])
            ->where($this->getUserType(), $this->getUserId())
            ->get()
            ->pluck('persons')
            ->flatten();
        return view('people.suspects', compact('people'));
    }
    public function view($id)
    {
        $person = Person::findOrFail($id);
        return response()->json([
            'person' => $person
        ]);
    }
    private function getUserId()
    {
        $id = auth()->user()->id;
        return $id;
    }
    private function getUserType()
    {
        $type = auth()->user()->user_type;
        if ($type == 1) {
            $var = 'user_id';
        } elseif ($type == 2) {
            $var = 'investigator_id';
        }
        return $var;
    }
}
