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

    /**
     * @OA\Post(
     *     path="/farmer/prices",
     *     operationId="setPrice",
     *     tags={"Prices"},
     *     summary="Set a price for a crop",
     *     description="Stores the price per kilogram for a specific crop.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Input data for setting the price",
     *         @OA\JsonContent(
     *             type="object",
     *             required={"crop_id", "price_per_kg"},
     *             @OA\Property(property="crop_id", type="integer", description="The ID of the crop"),
     *             @OA\Property(property="price_per_kg", type="number", format="float", description="Price per kilogram for the crop")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Price set successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Price set successfully!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error occurred",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="An error occurred. Please try again.")
     *         )
     *     )
     * )
     */
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
