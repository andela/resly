<?php

namespace Resly\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function currentReservations(Request $request)
    {
        // $this->authorize('diner-user');
        $bookings = $request->user()->bookings()->where('status', 1)->where('is_cancelled', 0)->where('scheduled_date', '>=', \Carbon\Carbon::now()->toDateTimeString())->get();

        return view('reservations.current', ['user' => $request->user(), 'reservations' => $bookings]);
    }

    public function pastReservations(Request $request)
    {
        $bookings = $request->user()->bookings()->where('status', 1)->where('scheduled_date', '<', \Carbon\Carbon::now()->toDateTimeString())->get();

        return view('reservations.past', ['user' => $request->user(), 'reservations' => $bookings]);
    }

    public function cancelledReservations(Request $request)
    {
        $bookings = $request->user()->bookings()->where('status', 0)->orWhere('is_cancelled', 1)->get();

        return view('reservations.cancelled', ['user' => $request->user(), 'reservations' => $bookings]);
    }

    public function cancelReservation(Request $request)
    {
        $booking = \Resly\Booking::find($request->id);
        $booking->status = 0;
        $booking->save();

        return redirect()->back()->with('info', 'Your reservation has been cancelled');
    }
}
