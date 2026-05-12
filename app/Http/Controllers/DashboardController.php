<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Treatment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = [
            'total_owners'    => Owner::count(),
            'total_pets'      => Pet::count(),
            'total_checkups'  => Checkup::count(),
            'total_treatments'=> Treatment::count(),
        ];

        $recentCheckups = Checkup::with(['pet.owner', 'treatment'])
            ->latest()
            ->take(5)
            ->get();

        $recentPets = Pet::with('owner')
            ->latest()
            ->take(5)
            ->get();

        $checkupsByType = Treatment::withCount('checkups')
            ->get()
            ->groupBy('type');

        return view('dashboard.index', compact('stats', 'recentCheckups', 'recentPets', 'checkupsByType'));
    }

}
