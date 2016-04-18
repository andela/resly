<?php

namespace Resly\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Resly\Repositories\TablesRepository;
use Resly\Table;

class TableController extends Controller
{
    public function __construct(TablesRepository $tablesRepository)
    {
        $this->tableRepository = $tablesRepository;
        // $this->authorize('restaurateur');
    }

    public function index()
    {
        //TODO display tables belonging to this restaurant and link to page for adding tables
    }

    /**
     * Displays form for adding table to restaurant.
     * @param Request $request
     * @return view
     */
    public function create(Request $request)
    {
        return view('table.create')->with([
            'restaurant_id' => $request->restaurant_id,
            'restaurant' => \Resly\Restaurant::find($request->restaurant_id),
            ]);
    }

    /**
     * Handles saving a table data.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $table = $this->tableRepository->store($request->all());
        $name = $table->label.'-'.$table->id;
        if ($request->hasFile('avatar')) {
            $this->saveAvatar($name, $table, $request);
        }

        return redirect()->back()->with('success', 'Table Added');
    }

    /**
     * Display update form.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $table = $this->tableRepository->get($request->table_id);

        return view('table.edit', compact('table'));
    }

    public function getTable(Request $request)
    {
        $table = $this->tableRepository->get($request->table_id);
        $table->cost = number_format($table->cost, 2);
        return json_encode($table);
    }

    public function getTables(Request $request)
    {
        $user = Auth::user()->id . Auth::user()->username;
        $tables = $request->session()->get($user, function () {
            return array();
        });
        $ids = array_values($tables);
        $bookedTables = array_map(function ($id) { return $this->tableRepository->get($id);}, $ids);
        array_map(function ($bookedTable) {$bookedTable->cost = number_format($bookedTable->cost, 2);}, $bookedTables);
        $sum = 0;
        $total_seats = 0;
        array_map(function ($bookedTable) use (&$sum, &$total_seats) { $sum = $sum + $bookedTable->cost; $total_seats = $total_seats + $bookedTable->seats_number;}, $bookedTables);
        $output = [
            'sum'           => $sum,
            'tables'        => array_values($bookedTables),
            'total_seats'   => $total_seats,
        ];

        return json_encode($output);
    }

    public function update(Request $request)
    {
        $data = $this->generateUpdateData($request->all());

        $this->tableRepository->update($request->table_id, $data);
        $table = Table::find($request->table_id);

        $name = $table->label.'-'.$table->id;

        if ($request->hasFile('avatar')) {
            $this->saveAvatar($name, $table, $request);
        }

        return redirect('/restaurants/'.$table->restaurant->id)->with('success', 'Table has been updated');
    }

    public function destroy(Request $request)
    {
        $this->tableRepository->delete($request->table_id);

        return redirect()->back()->with('success', 'Table has been deleted');
    }

    /**
     * Add tables in bulk.
     */
    public function addBulk(Request $request)
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
    public function createAddBulk(Request $request)
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

    public function showBookings(Request $request)
    {
        $table = Table::find($request->table_id);
        $bookings = $table->bookings()->where('status', 1)->where('scheduled_date', '>', \Carbon\Carbon::now()->toDateTimeString())->get();

        return view('bookings.list', [
            'table' => $table,
            'bookings' => $bookings,
            'restaurant' => $table->restaurant,
            ]);
    }

    private function saveAvatar($name, $table, $request)
    {
        //cloudinary public id for the image file
        $public_id = $name;

        //get path to file
        $tmp_avatar_path = $request->file('avatar')->getPathName();

        //upload file to cloudinary
        $result = $this->upload($tmp_avatar_path, $public_id);

        //save avatar in database
        $table->avatar = $result['url'];
        $table->save();
    }

    private function upload($filepath, $public_id)
    {
        //set cloudinary config options
        $res = \Cloudinary::config([
          'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
          'api_key'    => env('CLOUDINARY_API_KEY'),
          'api_secret' => env('CLOUDINARY_API_SECRET'),
        ]);

        //upload file
        $upload = \Cloudinary\Uploader::upload(
            $filepath,
            [
                'public_id' => $public_id,
                'crop'      => 'fill',
                'width'     => '400',
                'height'    => '400',
            ]
        );

        //return the uploaded file's meta
        return $upload;
    }

    private function generateUpdateData($data)
    {
        $output = [];
        foreach ($data as $key => $var) {
            if ((is_null($var) || $var != '' || $var != 0) && ($key !== '_token' &&  $key !== 'avatar')) {
                $output[$key] = $var;
            }
        }

        return $output;
    }
}
