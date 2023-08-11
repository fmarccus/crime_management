<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    public function getWitnesses()
    {
        $query = Issue::with(['persons' => function ($query) {
            $query->where('person_type', 'witness');
        }]);

        $userType = $this->getUserType();
        if (!empty($userType)) {
            $query->where($userType, $this->getUserId());
        }

        $people = $query->get()
            ->pluck('persons')
            ->flatten();
        return view('people.witnesses', compact('people'));
    }
    public function getSuspects()
    {
        $query = Issue::with(['persons' => function ($query) {
            $query->where('person_type', 'suspect');
        }]);

        $userType = $this->getUserType();
        if (!empty($userType)) {
            $query->where($userType, $this->getUserId());
        }

        $people = $query->get()
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
        } elseif ($type == 0) {
            $var = '';
        }
        return $var;
    }
}
