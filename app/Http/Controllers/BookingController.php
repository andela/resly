<?php

namespace Resly\Http\Controllers;

use Auth;
use Gate;
use Response;
use Validator;
use Resly\Slots;
use Resly\Table;
use Resly\Diner;
use Resly\Booking;
use Resly\Restaurant;
use Resly\Restaurateur;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Responds to GET /bookings
     * View the listings for bookings already made.
     */
    public function index()
    {
        // Check if authenticated user is Restaurateur.
        $user = Auth::user();
        if ($user->role === 'restaurateur') {
            $restaurant = $user->restaurant;

            return view(
                'bookings.rest',
                ['bookings' => $restaurant->bookings]
            );
        }

        return view(
            'bookings.diner',
            ['bookings' => $user->bookings]
        );
    }

    /**
     * Begin creating of a new booking.
     * Checks whether a table is available from the provided
     * restaurant, date and people.
     */
    public function begin(Request $request)
    {
        $restaurant_id = $request->input('restaurant_id');

        // Check if user is authenticated or redirect to login.
        if (Gate::denies('diner-user')) {
            $request->session()->put(
                'redirect_url',
                '/rest/'.$restaurant_id
            );

            return redirect('/auth/login')
                ->with('info', 'Login as Diner first.');
        }

        // Receives restaurant Id, number of tables
        $validator = Validator::make(
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
    public function create(Request $request)
    {
        $this->authorize('diner-user');

        $validator = Validator::make(
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
        return Response::make('Booking successful', 200);
    }

    /**
     *  responds to POST bookings/cancel
     *  removes the passed booking{$id} from DB.
     */
    public function cancel(Request $request)
    {
        $this->authorize('diner-user');

        // validate request
        $validator = Validator::make(
            $request->all(),
            ['booking_id' => 'required|numeric']
        );

        if ($validator->fails()) {
            return redirect('/bookings')
                ->withErrors($validator);
        }

        $booking = Booking::findOrFail($request->input('booking_id'));
        $booking->delete();

        return redirect('/bookings')
            ->with('info', 'Booking cancelled successfully.');
    }
}
