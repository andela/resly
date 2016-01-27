<?php

namespace Resly\Http\Controllers;

use DB;
use Resly\Restaurant;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    public function getResults(Request $request)
    {
        $query = $request->input('query');
        if (! $query) {
            return redirect()
            ->route('dinerhome')
            ->with('info', 'Could not find what you searched for');
        }

        $results = $this->restaurant->where(
            DB::raw('name'),
            'LIKE',
            "%{$query}%"
        )
        ->get();

        return view('search.results')->with('results', $results);
    }
}
