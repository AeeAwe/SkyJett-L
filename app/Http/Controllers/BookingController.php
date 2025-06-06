<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, Flight $flight)
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->back()->with('error', 'Администратор не может бронировать рейсы.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight->id,
            'status' => 'confirmed',
        ]);

        return redirect()->route('profile.index')->with('success', 'Рейс успешно забронирован.');
    }

    public function destroy(Booking $booking)
    {
        if (Auth::id() !== $booking->user_id) {
            abort(403);
        };

        $booking->delete();

        return redirect()->route('profile.index')->with('success', 'Бронь удалена.');
    }
}

