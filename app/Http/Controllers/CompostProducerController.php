<?php

namespace App\Http\Controllers;

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

}

