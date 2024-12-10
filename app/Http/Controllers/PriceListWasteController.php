<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\PriceListCompost;
use App\Models\PriceListWasteLog;
use Illuminate\Http\Request;
class PriceListWasteController extends Controller
{
    public function create(WasteLog $wasteLog)
    {
        return view('prices.create', compact('wasteLog'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'waste_log_id' => 'required|exists:waste_logs,id',
            'price_per_item' => 'required|numeric|min:0',
            'price_per_subscription_3' => 'required|numeric|min:0',
            'price_per_subscription_6' => 'required|numeric|min:0',
            'price_per_subscription_9' => 'required|numeric|min:0',
            'price_per_subscription_12' => 'required|numeric|min:0',
        ]);

        $priceList = new PriceListWasteLog($validated);
        $priceList->save();

        return redirect()->route('waste_log.list', ['restaurantOwnerID' => auth()->id()])
            ->with('success', 'Price list created successfully.');
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
