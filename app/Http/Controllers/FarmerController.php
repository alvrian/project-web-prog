<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmer;

class FarmerController extends Controller
{
    public function index()
    {
        return view("farmerMain");
    }

    public function subscribeToProducers(Request $request)
    {
        $farmer = auth()->user()->farmer;

        if (!$farmer) {
            return redirect()->back()->with('error', 'You do not have access to this section.');
        }

        $request->validate([
            'producer_ids' => 'required|array',
            'producer_ids.*' => 'exists:compost_producer,user_id',
        ]);

        $farmer->compostProducers()->sync($request->producer_ids);

        return redirect()->route('producers.index')->with('success', 'Subscriptions updated successfully.');
    }
}
