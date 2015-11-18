<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Table;

class TableController extends Controller
{
    public function __construct()
    {
        $this->authorize('restaurateur');
    }

    /**
     * Add tables in bulk.
     */
    public function getAddBulk(Request $request)
    {
        $restaurant_id = $request->session()->get('restaurant_id');

        return view(
            'table.bulk',
            ['restaurant_id' => $restaurant_id]
        );
    }

    /**
     *   Receive a POST request with
     *   JSON data containing tables to be added.
     */
    public function postAddBulk(Request $request)
    {
        // if the request has no data, return error code
        if (! $request->isJson()) {
            return 'false';
        }

        $tables = $request->json();
        $res_id = $tables->get('restaurant_id');
        $tables_sent = $tables->get('addedTables');

        foreach ($tables_sent as $seats => $number) {
            $seats_no = (int) $number;
            for ($i = 0; $i < $seats_no; $i++) {
                $table = new Table;
                $table->seats_number = (int) $seats;
                $table->restaurant_id = $res_id;
                $table->save();
            }
        }

        return $res_id;
    }
}
