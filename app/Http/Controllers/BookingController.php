<?php

namespace Resly\Http\Controllers;

use Auth;
use Gate;
use Cart;
use Response;
use Validator;
use Resly\Slots;
use Resly\Table;
use Resly\Diner;
use Resly\Booking;
use Resly\Restaurant;
use Resly\Restaurateur;
use Illuminate\Http\Request;
use Resly\Repositories\TablesRepository;
use URL;
use Session;

class BookingController extends Controller
{
    public function __construct(TablesRepository $tablerepository)
    {
        $this->tableRepo = $tablerepository;
    }

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

    public function book($restaurant_id)
    {
        $restaurant = Restaurant::where('id', $restaurant_id)->first();

        return view('bookings.book')
        ->with('restaurant', $restaurant);
    }

    public function addTable(Request $request)
    {
        if (Auth::guest()) {
            $request->session()->put('redirect_back', URL::previous());

            return redirect('/auth/login');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'duration' => 'required|digits_between:1,10',
                'date' => 'required|date_format:d/m/Y H:i',
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $table = $this->tableRepo->get($request->table_id);

        // User can only book 30mins from time.
        // A 2mins delay time is substracted in other to cater for any delay in
        // tranferring the request to the server.
        $allowedBookingDateTime = new \DateTime();
        $allowedBookingDateTime->add(new \DateInterval('PT28M'));

        $bookingDateTime = \DateTimeImmutable::createFromFormat('d/m/Y H:i', $request->date);

        $interval = $allowedBookingDateTime->diff($bookingDateTime);

        // Calculate the seconds difference between the allowedBookingDateTime and bookingDateTime
        // Reference: http://stackoverflow.com/questions/14277611/convert-dateinterval-object-to-seconds-in-php
        $seconds = date_create('@0')->add($interval)->getTimestamp();

        if ($seconds < 0) {
            Session::flash('error', 'The specified date and time must be greater than or equal to the next 30mins from now.');
        } else {
            //Convert to correct format
            $request->date = str_replace('/', '-', $request->date);
            Cart::add([
                'id' => time(),
                'name' => $table->label,
                'quantity' => 1,
                'price' => round($table->cost, 2),
                'attributes' => [
                    'item_id' => $table->id,
                    'date' => $request->date,
                    'duration' => $request->duration,
                    'type' => 'table',
                ],
            ]);
            Session::flash('success', 'Table added to cart');
        }

        return redirect()->back();
    }

    public function cart(Request $request)
    {
        return view('bookings.cart');
    }

    public function delteCartItem($item_id)
    {
        Cart::remove($item_id);

        return redirect()->back()->with('success', 'Item removed');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        $return = $user->charge(Cart::getTotal() * 100, [
            'source' => $request->stripeToken,
            'receipt_email' => $user->email,
        ]);

        $cart = Cart::getContent();

        $data = [];
        foreach ($cart as $item) {
            $temp['scheduled_date'] = date('Y-m-d H:i:s', strtotime($item->attributes->date));
            $temp['duration'] = $item->attributes->duration;
            $temp['type'] = $item->attributes->type;
            $temp['table_id'] = $item->attributes->item_id;
            $temp['user_id'] = Auth::user()->id;
            $temp['cost'] = $item->price;
            Booking::create($temp);
            $data[] = $temp;
        }

        // Booking::create($data);

        //clear cart
        $this->clearCart();

        return redirect('/')->with('success', 'Payment complete');
    }

    private function clearCart()
    {
        $cart_contents = Cart::getContent();
        foreach ($cart_contents as $index => $item) {
            Cart::remove($item->id);
        }
    }
}
