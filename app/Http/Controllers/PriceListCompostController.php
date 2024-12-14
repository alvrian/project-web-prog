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

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'compost_entry_id' => 'required|exists:compost_entries,id',
            'price_per_item' => 'required|numeric|min:0',
            'price_per_subscription_3' => 'required|numeric|min:0',
            'price_per_subscription_6' => 'required|numeric|min:0',
            'price_per_subscription_9' => 'required|numeric|min:0',
            'price_per_subscription_12' => 'required|numeric|min:0',
        ]);

        $compostLog = CompostEntry::findOrFail($id);

        $priceList = new PriceListCompost();
        $priceList->compost_entry_id = $compostLog->id;
        $priceList->price_per_item = $request->price_per_item;
        $priceList->price_per_subscription_3 = $request->price_per_subscription_3;
        $priceList->price_per_subscription_6 = $request->price_per_subscription_6;
        $priceList->price_per_subscription_9 = $request->price_per_subscription_9;
        $priceList->price_per_subscription_12 = $request->price_per_subscription_12;
        $priceList->save();

        return redirect()->route('compost.index')->with('success', 'Price list created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'compost_producer_name' => 'required|string|max:255',
            'compost_types_produced' => 'required|string|max:255',
            'average_compost_amount' => 'required|numeric|min:0',
            'kitchen_waste_capacity' => 'required|numeric|min:0',
            'date_logged' => 'nullable|date',
            'price_per_item' => 'required|numeric|min:0',
            'price_per_subscription_3' => 'required|numeric|min:0',
            'price_per_subscription_6' => 'required|numeric|min:0',
            'price_per_subscription_9' => 'required|numeric|min:0',
            'price_per_subscription_12' => 'required|numeric|min:0',
        ]);

        try {
            $entry = CompostEntry::findOrFail($id);

            $entry->update([
                'compost_producer_name' => $validatedData['compost_producer_name'],
                'compost_types_produced' => $validatedData['compost_types_produced'],
                'average_compost_amount' => $validatedData['average_compost_amount'],
                'kitchen_waste_capacity' => $validatedData['kitchen_waste_capacity'],
                'date_logged' => $validatedData['date_logged'],
            ]);

            if ($entry->priceList) {
                $entry->priceList->update([
                    'price_per_item' => $validatedData['price_per_item'],
                    'price_per_subscription_3' => $validatedData['price_per_subscription_3'],
                    'price_per_subscription_6' => $validatedData['price_per_subscription_6'],
                    'price_per_subscription_9' => $validatedData['price_per_subscription_9'],
                    'price_per_subscription_12' => $validatedData['price_per_subscription_12'],
                ]);
            } else {
                $entry->priceList()->create([
                    'price_per_item' => $validatedData['price_per_item'],
                    'price_per_subscription_3' => $validatedData['price_per_subscription_3'],
                    'price_per_subscription_6' => $validatedData['price_per_subscription_6'],
                    'price_per_subscription_9' => $validatedData['price_per_subscription_9'],
                    'price_per_subscription_12' => $validatedData['price_per_subscription_12'],
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Entry updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update entry.'], 500);
        }
    }

}
