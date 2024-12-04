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
            ->where('compost_producer_id', auth()->user()->id)
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

    public function showdetail($id)
    {
//        $compostEntry = CompostEntry::with('priceList', 'compostProducer')->findOrFail($id);

        $compostEntry = CompostEntry::with('price_list')->findOrFail($id);

        return view('composters.show-detail', compact('compostEntry'));
    }

    public function edit($id)
    {
        $entry = CompostEntry::with('priceList')->findOrFail($id);
        return view('compost.edit', compact('entry'));
    }




    public function update(Request $request, $id)
    {
        $entry = CompostEntry::findOrFail($id);

        // Validate input
        $request->validate([
        'compost_producer_name' => 'required|string|max:255',
        'compost_types_produced' => 'required|string|max:255',
        'average_compost_amount' => 'required|numeric',
        'kitchen_waste_capacity' => 'required|numeric',
        'date_logged' => 'nullable|date',
        'price_per_item' => 'nullable|numeric|min:0',
        'price_per_subscription_3' => 'nullable|numeric|min:0',
        'price_per_subscription_6' => 'nullable|numeric|min:0',
        'price_per_subscription_9' => 'nullable|numeric|min:0',
        'price_per_subscription_12' => 'nullable|numeric|min:0',
        ]);

        // Update compost entry
        $entry->update($request->only([
        'compost_producer_name',
        'compost_types_produced',
        'average_compost_amount',
        'kitchen_waste_capacity',
        'date_logged',
        ]));

        // Update pricing details or create them if they don't exist
        if ($entry->priceList) {
            $entry->priceList->update($request->only([
            'price_per_item',
            'price_per_subscription_3',
            'price_per_subscription_6',
            'price_per_subscription_9',
            'price_per_subscription_12',
            ]));
        } else {
            $entry->priceList()->create($request->only([
            'price_per_item',
            'price_per_subscription_3',
            'price_per_subscription_6',
            'price_per_subscription_9',
            'price_per_subscription_12',
            ]));
        }

        return redirect()->route('compost.index')->with('success', 'Compost entry updated successfully!');
    }
}
