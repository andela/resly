<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;
use Resly\Booking;
use Resly\Table;
use Resly\Slots;
use Resly\Restaurant;
use Resly\Restaurateur;
use Resly\Diner;

class BookingController extends Controller
{
    /**
     * View the listings for bookings already made.
     * Responds to GET /bookings
     */
    public function getIndex()
    {
        // Check if authenticated user is Restaurateur.
        $user = \Auth::user();
        if ($user instanceof Restaurateur) {
            $restaurant = $user->restaurant;

            return view(
                'bookings.all',
                ['bookings' => $restaurant->bookings]
            );
        }

        return view(
            'bookings.all',
            ['bookings' => $user->bookings]
        );
    }

    /**
     * Begin creating of a new booking.
     * Checks whether a table is available from the provided
     * restaurant, date and people.
     */
    public function postBegin(Request $request)
    {
        $this->authorize('book');

        // Receives restaurant Id, number of tables
        $validator = \Validator::make(
            $request->all(),
            [
                'restaurant_id' => 'required|numeric',
                'number_of_people' => 'required|numeric',
                'booking_date' => 'required|date',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $seats_number = $request->input('number_of_people');
        $booking_date = $request->input('booking_date');
        $restaurant_id = $request->input('restaurant_id');

        $match = [
                    'seats_number' => $seats_number,
                    'restaurant_id' => $restaurant_id,
                ];

        $table = Table::where($match)
                        ->first();
        $restaurant = Restaurant::findOrFail($restaurant_id);

        if (empty($table)) {
            return redirect()
                ->back()
                ->with('info', 'No table available on that day.');
        }

        $match = [
            'table_id' => $table->table_id,
            'booking_date' => $booking_date,
        ];
        $bookings = Booking::where($match)
                    ->orderBy('booking_time')
                    ->get();

        $opening_time = $restaurant->opening_time;
        $closing_time = $restaurant->closing_time;

        $slots = Slots::make(
            $opening_time,
            $closing_time,
            $bookings
        );

        return view('bookings.create', [
            'slots' => $slots,
            'booking_date' => $booking_date,
            'number_of_people' => $seats_number,
            'table_id' => $table->table_id,
        ]);
    }

    /**
     * Create and store a new booking from the provided
     * information.
     */
    public function postCreate(Request $request)
    {
        $this->authorize('book');

        $validator = \Validator::make(
            $request->all(),
            [
                'table_id' => 'required|numeric',
                'booking_date' => 'required',
                'booking_time' => 'required',
                'number_of_people' => 'required|numeric',
            ]
        );

        if ($validator->fails()) {
            return redirect('/bookings/create')
                ->withErrors($validator);
        }

        $diner_id = $request->session()->get('user_id');

        $booking = $request->all();
        $booking['diner_id'] = $diner_id;

        $created_booking = Booking::create($booking);

        // Return success view here
        return \Response::make('Booking successful', 200);
    }
}
