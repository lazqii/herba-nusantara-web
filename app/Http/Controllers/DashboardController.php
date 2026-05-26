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
        
        $totalTanaman = \App\Models\Tanaman::count();
        $pendingDataset = \App\Models\Contribution::where('status', 'pending')->count();
        
        $totalDataset = \App\Models\Contribution::count();

        return view('dashboard', compact('totalTanaman', 'pendingDataset', 'totalDataset'));
    }
}