<?php

namespace Resly\Http\Controllers;

use DB;
use Auth;

class DinerProfileController extends Controller
{
    public function getIndex()
    {
        $name = DB::table('Diner')->where('fname', Auth::diner()->get()->fname)->first();

        return view('profile.dinerProfile')->with('name', $name);
    }
}
