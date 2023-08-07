<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getBarangayCrimeData(Request $request)
    {
        $area = $request->input('area', '');
        $crimeBarangayCount = DB::table('issues')->where('area', $area)
            ->selectRaw('type, COUNT(*) as count')->groupBy('type')->get()->pluck('count')->toArray();

        $crimeBarangayName = DB::table('issues')->where('area', $area)
            ->selectRaw('type, COUNT(*) as count')->groupBy('type')->get()->pluck('type')->toArray();

        return response()->json([
            'barangayName' => $crimeBarangayName,
            'barangayCount' => $crimeBarangayCount,
        ]);
    }
}
