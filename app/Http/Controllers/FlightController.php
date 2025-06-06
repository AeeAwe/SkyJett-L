<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        try {
            $flights = Flight::latest()->get();
            $dbError = false;
        } catch (QueryException $e) {
            $flights = null;
            $dbError = true;
        }
        return view('pages.flights', compact('flights', 'dbError'));
    }
}
