<?php

namespace App\Http\Controllers;

use App\Models\Complainant;
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
}
