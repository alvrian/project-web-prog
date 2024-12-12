<?php

namespace App\Http\Controllers;

use App\Models\PriceListWasteLog;
use App\Models\WasteLog;
use Illuminate\Http\Request;

class PriceListWasteController extends Controller
{
    public function create(WasteLog $wasteLog)
    {
        return view('prices.create', compact('wasteLog'));
    }


    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'price_per_item' => 'required|numeric|min:0',
            'price_per_subscription_3' => 'required|numeric|min:0',
            'price_per_subscription_6' => 'required|numeric|min:0',
            'price_per_subscription_9' => 'required|numeric|min:0',
            'price_per_subscription_12' => 'required|numeric|min:0',
        ]);

        $wasteLog = WasteLog::findOrFail($id);

        $priceList = new PriceListWasteLog();
        $priceList->WasteLogID = $wasteLog->id;
        $priceList->price_per_kg = $request->price_per_item;
        $priceList->price_per_subscription_3 = $request->price_per_subscription_3;
        $priceList->price_per_subscription_6 = $request->price_per_subscription_6;
        $priceList->price_per_subscription_9 = $request->price_per_subscription_9;
        $priceList->price_per_subscription_12 = $request->price_per_subscription_12;
        $priceList->save();

        return redirect()->route('waste_log.list', ['restaurantOwnerID' => $wasteLog->RestaurantOwnerID]);
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

        $priceList = PriceListWasteLog::findOrFail($id);
        $priceList->update($validated);

        return redirect()->route('waste_log.list', ['restaurantOwnerID' => auth()->id()])
            ->with('success', 'Price list updated successfully.');
    }
}
