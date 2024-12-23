<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\CompostProducer;
use Illuminate\Http\Request;

class CompostProducerController extends Controller
{

    public function index(Request $request)
    {
        $query = CompostProducer::query();

        if ($request->filled('name')) {
            $query->where('Name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('compost_type')) {
            $query->where('CompostTypesProduced', 'like', '%' . $request->input('compost_type') . '%');
        }

        $compostProducers = $query->get();

        return view('composters.index', compact('compostProducers'));
    }

    public function show($composterId)
    {
        $producer = CompostProducer::with(['subscriptions', 'compostEntries.priceList'])
            ->where('user_id', $composterId)
            ->first();

        if (!$producer) {
            return abort(404, 'Compost Producer not found.');
        }

        $compostEntries = CompostEntry::with('priceList')
            ->where('compost_producer_id', $composterId)
            ->get();

        return view('composters.show', compact('producer', 'compostEntries'));
    }

    public function details($composterId, $compostId)
    {
        $user = auth()->user();

        if ($user->role === "farmer" && $user->farmer) {
            $totalPoints = $user->farmer->PointsBalance;
        }

        $compostEntry = CompostEntry::with(['priceList', 'compostProducer'])
            ->where('compost_producer_id', $composterId)
            ->findOrFail($compostId);

        return view('composters.show-detail', compact('compostEntry', 'totalPoints'));
    }

}

