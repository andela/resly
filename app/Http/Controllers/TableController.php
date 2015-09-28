<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;

use Resly\Table;

class TableController extends Controller
{
    /**
     * Add tables in bulk
     */

    public function getAddBulk()
    {
        return view('table.bulk');
    }

    /**
    *   Receive a POST request with
    *   JSON data containing tables to be added
    */

    public function postAddBulk(Request $request)
    {
        // if the request has no data, return error code
        if(! $request->isJson()) {
            return "false";
        }

        $tables = $request->json();

        foreach ($tables as $seats => $number) {
            $seats = (int)$number;
            for ($i = 0; $i < $number; $i++) { 
                $table = new Table;
                $table->seats_number = (int)$seats;
                $table->save();
            }
        }
        return "success";
    }
}
