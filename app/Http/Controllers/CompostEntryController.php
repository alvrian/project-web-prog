<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompostEntryController extends Controller
{
    /**
     * @OA\Get(
     *     path="compost-producer/create-compost",
     *     operationId="createCompostEntry",
     *     tags={"Compost Entries"},
     *     summary="Show the form to create a new compost entry",
     *     description="Displays the form for logging a new compost entry.",
     *     @OA\Response(
     *         response=200,
     *         description="Form displayed successfully"
     *     )
     * )
     */
    public function create()
    {
        return view('compostLogCreate');
    }

    /**
     * @OA\Post(
     *     path="/compost-producer/create-compost",
     *     operationId="storeCompostEntry",
     *     tags={"Compost Entries"},
     *     summary="Log a new compost entry",
     *     description="Stores a new compost entry in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="compost_types_produced", type="string"),
     *                 @OA\Property(property="average_compost_amount", type="number", format="float"),
     *                 @OA\Property(property="kitchen_waste_capacity", type="number", format="float"),
     *                 @OA\Property(property="date_logged", type="string", format="date")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Compost entry created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Compost data logged successfully!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Validation failed."),
     *             @OA\Property(property="details", type="array", @OA\Items(type="string"))
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'compost_types_produced' => 'required|string|max:255',
            'average_compost_amount' => 'required|numeric|min:0',
            'kitchen_waste_capacity' => 'required|numeric|min:0',
            'date_logged' => 'required|date',
        ]);

        CompostEntry::create([
            'compost_producer_id' => Auth::id(),
            'compost_producer_name' => Auth::user()->name,
            'compost_types_produced' => $request->compost_types_produced,
            'average_compost_amount' => $request->average_compost_amount,
            'kitchen_waste_capacity' => $request->kitchen_waste_capacity,
            'date_logged' => $request->date_logged,
        ]);

        return redirect()->route('compost.create')->with('success', 'Compost data logged successfully!');
    }
}
