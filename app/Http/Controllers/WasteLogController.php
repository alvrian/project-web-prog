<?php

namespace App\Http\Controllers;

use App\Models\WasteLog;
use Illuminate\Http\Request;

class WasteLogController extends Controller
{
    public function create()
    {
        return view('wasteLogCreate');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'WasteType' => 'required|string|max:255',
        'Weight' => 'required|numeric|min:0',
        'DateLogged' => 'required|date',
    ]);

    //TODO:
    // make  auth
    // $restaurantOwner = auth()->user()->restaurantOwner;

    WasteLog::create([
        //TODO:
        'RestaurantOwnerID' => '1',
        'WasteType' => $validated['WasteType'],
        'Weight' => $validated['Weight'],
        'DateLogged' => $validated['DateLogged'],
    ]);
    
    return redirect()->route('waste_log.create')->with('success', 'Food waste logged successfully!');
}


    public function index()
    {
        $restaurantOwner = auth()->user()->restaurantOwner;

        $wasteLogs = WasteLog::where('RestaurantOwnerID', $restaurantOwner->id)
            ->orderBy('DateLogged', 'desc')
            ->get();

        return view('waste_log.index', compact('wasteLogs'));
    }

    public function report()
    {
        
        $wasteLogs = WasteLog::orderBy('DateLogged', 'desc')->get();
        return view('restaurantWasteReport', compact('wasteLogs'));
    }

}
