<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanaman; // We will use this later
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        return view('dashboard');
    }
}