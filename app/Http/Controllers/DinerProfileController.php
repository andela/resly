<?php

namespace Resly\Http\Controllers;

use Resly\Diner;
use Auth;

class DinerProfileController extends Controller
{
    public function show($fname)
    {
        //$name = DB::table('Diner')->where('fname', Auth::diner()->get()->fname)->first();
        $cust = Diner::whereFname($fname)->first();
        //dd($cust);

        return view('diner.home')->with('cust', $cust);
    }
}
