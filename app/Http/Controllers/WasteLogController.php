<?php

namespace App\Http\Controllers;

use App\Models\WasteLog;
use Illuminate\Http\Request;

class WasteLogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/restaurant-owner/create-waste-log",
     *     operationId="createWasteLog",
     *     tags={"Waste Logs"},
     *     summary="Show the form to create a new waste log",
     *     description="Returns the view for creating a new waste log.",
     *     @OA\Response(
     *         response=200,
     *         description="Form view for creating a waste log returned successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Form for creating a waste log loaded successfully.")
     *         )
     *     )
     * )
     */
    public function create()
    {
        return view('wasteLogCreate');
    }

    /**
     * @OA\Post(
     *     path="/restaurant-owner/create-waste-log",
     *     operationId="storeWasteLog",
     *     tags={"Waste Logs"},
     *     summary="Store a new waste log entry",
     *     description="Validates and stores a new waste log entry.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data for the new waste log entry",
     *         @OA\JsonContent(
     *             required={"WasteType", "Weight", "DateLogged"},
     *             @OA\Property(property="WasteType", type="string", example="Food waste"),
     *             @OA\Property(property="Weight", type="number", format="float", example=10.5),
     *             @OA\Property(property="DateLogged", type="string", format="date", example="2024-12-02")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Waste log entry created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Food waste logged successfully!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Validation failed")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'WasteType' => 'required|string|max:255',
            'Weight' => 'required|numeric|min:0',
            'DateLogged' => 'required|date',
        ]);

        //TODO:
        // make  auth
        // $restaurantOwner = auth()->user()->restaurantOwner;

        WasteLog::create([
            //TODO:
            'RestaurantOwnerID' => '1',
            'WasteType' => $validated['WasteType'],
            'Weight' => $validated['Weight'],
            'DateLogged' => $validated['DateLogged'],
        ]);

        return redirect()->route('waste_log.create')->with('success', 'Food waste logged successfully!');
    }

    public function index()
    {
        $restaurantOwner = auth()->user()->restaurantOwner;

        $wasteLogs = WasteLog::where('RestaurantOwnerID', $restaurantOwner->id)
            ->orderBy('DateLogged', 'desc')
            ->get();

        return view('waste_log.index', compact('wasteLogs'));
    }
}
