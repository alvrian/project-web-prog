<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

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

    public function index(Request $request)
{
    $compostEntries = CompostEntry::with('priceList')
        ->when($request->has('search'), function ($query) use ($request) {
            $query->where('compost_producer_name', 'like', '%' . $request->input('search') . '%');
        })
        ->paginate(10);

    return view('compost.index', compact('compostEntries'));
}

public function show($id)
{
    $entry = CompostEntry::with('compostProducer', 'priceList')
        ->where('compost_producer_id', $id)
        ->firstOrFail();

    return view('compost.show', compact('entry'));
}

public function edit(CompostEntry $compostEntry)
{
    $compostEntry->load('priceList');
    return view('compost.edit', compact('compostEntry'));
}


public function update(Request $request, CompostEntry $compostEntry)
{
    $validated = $request->validate([
        'compost_producer_name' => 'required|string|max:255',
        'compost_types_produced' => 'required|string|max:255',
        'average_compost_amount' => 'required|numeric|min:0',
        'kitchen_waste_capacity' => 'required|numeric|min:0',
        'date_logged' => 'required|date',
        'price_per_item' => 'required|numeric|min:0',
        'price_per_subscription_3' => 'required|numeric|min:0',
        'price_per_subscription_6' => 'required|numeric|min:0',
        'price_per_subscription_9' => 'required|numeric|min:0',
        'price_per_subscription_12' => 'required|numeric|min:0',
    ]);

    $compostEntry->update($validated);

    $priceList = $compostEntry->priceList()->firstOrNew();
    $priceList->fill($validated);
    $priceList->save();

    return redirect()->route('compost.show', $compostEntry)->with('success', 'Compost entry updated successfully!');
}

}
