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

        if ($request->has('name') && $request->input('name') != '') {
            $query->where('Name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('compost_type') && $request->input('compost_type') != '') {
            $query->where('CompostTypesProduced', 'like', '%' . $request->input('compost_type') . '%');
        }

        $compostProducers = $query->get();
        return view('composters.index', compact('compostProducers'));
    }

    public function show($id)
    {
        $producer = CompostProducer::with(['subscriptions', 'compostEntries.priceList'])
            ->where('user_id', $id)
            ->first();

        if (!$producer) {
            return abort(404, 'Compost Producer not found.');
        }

        $compostEntries = CompostEntry::with('priceList')
            ->where('compost_producer_id', $id)
            ->get();

        return view('composters.show', compact('producer', 'compostEntries'));
    }
    public function showDetail($id)
    {
        $compostProducer = CompostProducer::findOrFail($id);

        $compostEntries = CompostEntry::with('priceList')
            ->where('compost_producer_id', $id)
            ->get();

        return view('composters.show-detail', compact('compostProducer', 'compostEntries'));
    }
}

