<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->load('bookings','reviews');

        $response =  response()->view('pages.profile', [
            'user' => $user,
            'bookings' => $user->bookings ?? [],
            'reviews' => $user->reviews ?? [],
        ]);

        return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', '0');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function destroy(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->delete();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'Аккаунт успешно удалён.');
    }
}
