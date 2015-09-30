<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        $query = $request->input('query');
        dd($query);
        return view('search.results');
    }

}
