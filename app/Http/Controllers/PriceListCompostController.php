<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\PriceListCompost;
use Illuminate\Http\Request;

class PriceListCompostController extends Controller
{
    public function create(CompostEntry $compostEntry)
    {
        return view('prices.create', compact('compostEntry'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'compost_entry_id' => 'required|exists:compost_entries,id',
            'price_per_item' => 'required|numeric|min:0',
            'price_per_subscription_3' => 'required|numeric|min:0',
            'price_per_subscription_6' => 'required|numeric|min:0',
            'price_per_subscription_9' => 'required|numeric|min:0',
            'price_per_subscription_12' => 'required|numeric|min:0',
        ]);

        $priceList = new PriceListCompost($validated);
        $priceList->save();

        return redirect()->route('compost.index')->with('success', 'Price list created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'price_per_item' => 'required|numeric|min:0',
            'price_per_subscription_3' => 'required|numeric|min:0',
            'price_per_subscription_6' => 'required|numeric|min:0',
            'price_per_subscription_9' => 'required|numeric|min:0',
            'price_per_subscription_12' => 'required|numeric|min:0',
        ]);

        $priceList = PriceListCompost::findOrFail($id);
        $priceList->update($validated);

        return redirect()->route('compost.index')->with('success', 'Price list updated successfully.');
    }
}
