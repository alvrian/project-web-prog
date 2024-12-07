<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\WasteLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function index(Request $request)
    {

        $wasteEntries = WasteLog::when($request->has('search'), function ($query) use ($request) {
            $query->where('WasteType', 'like', '%' . $request->input('search') . '%');
        })
            ->where('RestaurantOwnerID', auth()->user()->id)
            ->paginate(10);


        return view('waste_log.index', compact('wasteEntries'));
    }

    public function show($id)
    {
        $entry = WasteLog::findOrFail($id);

        return view('waste_log.show', compact('entry'));
    }

    public function edit($id)
    {
        $entry = WasteLog::findOrFail($id);
        return view('waste_log.edit', compact('entry'));
    }

    public function update(Request $request, $id)
    {
        $entry = WasteLog::findOrFail($id);

        $request->validate([
            'WasteType' => 'required|string|max:255',
            'Weight' => 'required|numeric|min:0',
        ]);

        $entry->update($request->only([
            'WasteType',
            'Weight',
        ]));

        return redirect()->route('waste_log.show', ['id' => $entry->id])->with('success', 'Waste Log details updated successfully.');
    }


    public function list()
    {
        $wasteLogs = WasteLog::where('RestaurantOwnerID', '1')
            ->orderBy('DateLogged', 'desc')
            ->paginate(10);

        return view('wasteReport', compact('wasteLogs'));
    }

}
