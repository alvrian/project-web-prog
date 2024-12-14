<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\PriceListCrop;
use Illuminate\Http\Request;

class PriceListCropController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'price_per_item' => 'required|numeric|min:0',
            'price_per_subscription_3' => 'required|numeric|min:0',
            'price_per_subscription_6' => 'required|numeric|min:0',
            'price_per_subscription_9' => 'required|numeric|min:0',
            'price_per_subscription_12' => 'required|numeric|min:0',
        ]);

        $crop = Crop::findOrFail($request->crop_id);

        $priceList = PriceListCrop::updateOrCreate(
            ['crop_id' => $request->crop_id],
            [
                'price_per_item' => $request->price_per_item,
                'price_per_subscription_3' => $request->price_per_subscription_3,
                'price_per_subscription_6' => $request->price_per_subscription_6,
                'price_per_subscription_9' => $request->price_per_subscription_9,
                'price_per_subscription_12' => $request->price_per_subscription_12,
            ]
        );

        return redirect()->route('crops.index')
            ->with('success', 'Prices for ' . $crop->crop_name . ' updated successfully!');
    }
}
