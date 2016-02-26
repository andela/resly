<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Restaurant;
use DB;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        $query = strtolower($request->input('query'));
        if (! $query) {
            return redirect()->back();
        }

        $results = Restaurant::where(
            DB::raw('name'),
            'LIKE',
            "%{$query}%"
        )
        ->get();

        return view('search.results')->with('results', $results);
    }
}
