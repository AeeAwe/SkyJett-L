<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexUsers(){
        $users = User::with('bookings')->get();
        return view('pages.admin.admin_users', compact('users'));
    }
    public function indexFlights(){
        $flights = Flight::all();

        return view('pages.admin.admin_flights', compact('flights'));
    }
    public function create()
    {
        return view('pages.admin.flights_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'description' => 'nullable|string',
            'departure' => 'required|date|after_or_equal:now',
            'arrival' => 'required|date|after:departure',
            'class' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('flights', 'public');
            $validated['image'] = $path;
        }

        Flight::create($validated);

        return redirect()->route('admin.flights')->with('success', 'Рейс добавлен.');
    }

    public function edit(Flight $flight)
    {
        return view('pages.admin.flights_edit', compact('flight'));
    }

    public function update(Request $request, Flight $flight)
    {
        $data = $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'description' => 'nullable|string',
            'departure' => 'required|date|after_or_equal:now',
            'arrival' => 'required|date|after:departure',
            'class' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['from', 'to', 'description', 'departure', 'arrival', 'class', 'price']);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('flights', 'public');
            $data['image'] = $path;
        }

        $flight->update($data);

        return redirect()->route('admin.flights')->with('success', 'Рейс обновлен.');
    }

    public function flightDestroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('admin.flights')->with('success', 'Рейс удален.');
    }

    public function userDestroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Пользователь удален.');
    }

    public function bookingDestroy(User $user, Booking $booking)
    {
        if ($user->id !== $booking->user_id){
            abort(403);
        };

        $booking->delete();

        return redirect()->route('admin.users')->with('success', 'Бронь пользователя удалена.');
    }
}