<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Http\Requests;
use Resly\Http\Controllers\Controller;
use Resly\Booking;
use Resly\Table;
use Resly\Slots;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('bookings.select');
    }

    /**
     * Show the form for creating a new booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function postBegin(Request $request)
    {
        // Add validation of request here.

        $diner_id = \Auth::diner()->get()->id;
        $seats_number = $request->input('seats_number');
        $booking_date = $request->input('booking_date');

        $table = Table::where('seats_number', $seats_number)
                        ->first();

        if (empty($table)) {
            return view('bookings.create', ['slots' => []]);
        }

        $match = [
            'table_id' => $table->id,
            'booking_date' => $booking_date
        ];
        $bookings = Bookings::where($match)
                    ->orderBy('booking_time')
                    ->get();
        $bookings = self::transformBooking($bookings);

        // Grab a restaurant and make a slot

        $slots = Slots::make(
            $opening_time,
            $closing_time,
            $bookings
        );
        
        return view('bookings.create', ['slots' => $slots]);
    }

    /**
     * Create and store a new booking from the provided
     * information.
     */

    public function postCreate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'table_id' => 'required|numeric',
                'booking_date' => 'required',
                'booking_time' => 'required|numeric',
                'number_of_people' => 'required|required',
            ]
        );

        if ($validator->fails()) {
            return redirect('/bookings/create')
                ->withErrors($validator);
        }

        $diner_id = \Auth::diner()->get()->id;

        $booking = ['diner_id' => $diner_id];
        array_push($booking, $request->all());

        $created_booking = Booking::create($booking);

        // Return success view here
        return view('Booking made, <br>'+var_dump($created_booking));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *  Take the bookings returned from an eloquent querry
     *  and passed in, and return an array of times.
     */
    private static function transformBooking($bookings = null)
    {
        if (empty($bookings)) {
            return false;
        }
        $final_bookings = [];
        foreach ($bookings as $booking) {
            $final_bookings[] = $booking->time;
        }
        return $final_bookings;
    }
}
