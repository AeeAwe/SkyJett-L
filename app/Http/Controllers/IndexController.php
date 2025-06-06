<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Database\QueryException;

class IndexController extends Controller
{
    public function index()
    {
        try {
            $popularFlights = Flight::orderBy('created_at', 'desc')->take(3)->get();
            $dbError = false;
        } catch (QueryException $e) {
            $popularFlights = null;
            $dbError = true;
        }
        return view('pages.index', compact('popularFlights', 'dbError'));
    }
}