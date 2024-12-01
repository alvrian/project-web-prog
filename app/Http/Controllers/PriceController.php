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

    public function store(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        $price = new Price($validated);
        $crop->prices()->save($price);

        return redirect()->route('crops.show', $crop->id)->with('success', 'Price added successfully!');
    }
}

