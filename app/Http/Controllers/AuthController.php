<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $response = response()->view('pages.auth');

        return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', '0');
    }
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:20|unique:users,phone',
                'password' => 'required|string|min:6',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);
        } catch (ValidationException $e) {
            return back()
            ->withErrors($e->validator)
            ->withInput()
            ->with('activeTab', 'register');
        } catch (QueryException $e){
            return back()->withErrors([
                'db' => 'Ошибка сервера. Не удалось установить соединение.',
            ])->withInput()->with('activeTab', 'register');
        } 

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
        } catch (QueryException $e){
            return back()->withErrors([
                'db' => 'Ошибка сервера. Не удалось установить соединение.',
            ])->withInput()->with('activeTab', 'login');
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'Неверный email или пароль.',
            ])->withInput()->with('activeTab', 'login');
        }
        Auth::login($user);

        return redirect()->route('home');
    }
}
