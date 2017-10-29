<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function create(Request $request)
    {
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'pump_id' => $request->pump_id,
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
        ]);
    }
}
