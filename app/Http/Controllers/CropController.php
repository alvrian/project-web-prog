<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;

class CropController extends Controller
{
    public function create()
    {
        return view('cropLogCreate');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:users,id',
            'crop_name'=> 'required|string',
            'crop_type' => 'required|string',
            'average_amount' => 'required|numeric|min:1',
            'harvest_cycles' => 'required|integer|min:1',
            'crop_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'availability_start' => 'required|date',
            'availability_end' => 'required|date|after_or_equal:availability_start',
        ]);

        $imagePath = $request->file('crop_image')->store('crop_images', 'public');

        Crop::create([
            'farmer_id' => $validated['farmer_id'],
            'crop_name' => $validated['crop_name'],
            'crop_type' => $validated['crop_type'],
            'average_amount' => $validated['average_amount'],
            'harvest_cycles' => $validated['harvest_cycles'],
            'crop_image' => $imagePath,
            'availability_start' => $validated['availability_start'],
            'availability_end' => $validated['availability_end'],
        ]);

        return redirect()->back()->with('success', 'Crop data logged successfully!');
    }
}

