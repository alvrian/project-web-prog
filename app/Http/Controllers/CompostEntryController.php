<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompostEntryController extends Controller
{

    public function create()
    {
        return view('compostLogCreate');
    }
    public function store(Request $request)
    {
        $request->validate([
            'compost_types_produced' => 'required|string|max:255',
            'average_compost_amount' => 'required|numeric|min:0',
            'kitchen_waste_capacity' => 'required|numeric|min:0',
            'date_logged' => 'required|date',
        ]);

        CompostEntry::create([
            'compost_producer_id' => Auth::id(),
            'compost_producer_name' => Auth::user()->name,
            'compost_types_produced' => $request->compost_types_produced,
            'average_compost_amount' => $request->average_compost_amount,
            'kitchen_waste_capacity' => $request->kitchen_waste_capacity,
            'date_logged' => $request->date_logged,
        ]);

        return redirect()->route('compost.create')->with('success', 'Compost data logged successfully!');
    }
}
