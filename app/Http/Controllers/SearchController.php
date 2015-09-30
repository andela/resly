<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        $query = $request->input('query');
        dd($query);

        return view('search.results');
    }
}
