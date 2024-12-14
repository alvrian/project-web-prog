<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function create(Crop $crop)
    {
        return view('prices.create', compact('crop'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        try {
            $price = new Price();
            $price->crop_id = $request->input('crop_id');
            $price->price_per_kg = $request->input('price_per_kg');
            $price->save();

            return redirect()->route('crops.index')->with('success', 'Price set successfully!');
        } catch (\Exception $e) {
            return redirect()->route('crops.index')->with('error', 'An error occurred. Please try again.');
        }
    }
}
