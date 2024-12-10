<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\Crop;
use App\Models\RestaurantOwner;
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


    public function list($restaurantOwnerID)
    {
        $wasteLogs = WasteLog::where('RestaurantOwnerID', $restaurantOwnerID)
            ->orderBy('DateLogged', 'desc')
            ->paginate(10);

        return view('wasteReport', compact('wasteLogs'));
    }


    public function indexOwner(Request $request)
    {
        $query = RestaurantOwner::query();

        if ($request->filled('restaurant_name')) {
            $query->where('Name', 'like', '%' . $request->input('restaurant_name') . '%');
        }

        if ($request->filled('type')) {
            $query->where('Type', 'like', '%' . $request->input('type') . '%');
        }

        $restaurantOwners = $query->get();

        return view('waste_logs.index', compact('restaurantOwners'));
    }


    public function showOwner($ownerID)
    {
        $owner = RestaurantOwner::with(['wasteLogs.priceList'])
            ->where('user_id', $ownerID)
            ->first();

        if (!$owner) {
            return abort(404, 'Restaurant Owner not found.');
        }

        $wasteLogs = WasteLog::with('priceList')
            ->where('RestaurantOwnerID', $ownerID)
            ->get();

        return view('waste_logs.show', compact('owner', 'wasteLogs'));
    }


    public function detailOwner($ownerID, $wastelogID)
    {
        $user = auth()->user();
        $totalPoints = 0;

        if ($user->role === "compost_producer") {
            $totalPoints = $user->compostProducer->PointsBalance ?? 0;
        }


        $wasteLog = WasteLog::with(['priceList', 'compostProducer'])
            ->where('RestaurantOwnerID', $ownerID)
            ->findOrFail($wastelogID);

        return view('waste_logs.show-detail', compact('wasteLog', 'totalPoints'));
    }


}
