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

    public function index(Request $request)
    {
        $query = Crop::query();

        if ($request->crop_type) {
            $query->where('crop_type', $request->crop_type);
        }

        if ($request->start_date) {
            $query->whereDate('availability_start', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('availability_end', '<=', $request->end_date);
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('crop_name', 'like', '%' . $search . '%');
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $order = $request->input('order') === 'desc' ? 'desc' : 'asc';
            $query->orderBy($sort, $order);
        }

        $crops = Crop::with('prices')
        ->when($request->has('crop_type'), function ($query) use ($request) {
            $query->where('crop_type', $request->input('crop_type'));
        })
        ->when($request->has('start_date'), function ($query) use ($request) {
            $query->whereDate('availability_start', '>=', $request->input('start_date'));
        })
        ->when($request->has('end_date'), function ($query) use ($request) {
            $query->whereDate('availability_end', '<=', $request->input('end_date'));
        })
        ->get();


        $crops = $query->with('prices')->paginate(10);
        return view('crops.index', compact('crops'));
    }

    public function show(Crop $crop)
    {
        return view('crops.show', compact('crop'));
    }
}

