<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/farmer/orders/{crop}/create",
     *     operationId="createOrder",
     *     tags={"Crops"},
     *     summary="Show the form for creating an order for a specific crop",
     *     description="Returns the view for creating an order for a crop based on the provided ID.",
     *     @OA\Parameter(
     *         name="crop",
     *         in="path",
     *         required=true,
     *         description="ID of the crop for which the order is to be created",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Form view for creating an order loaded successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Form for creating an order loaded successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Crop not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Crop not found")
     *         )
     *     )
     * )
     */
    public function create(Crop $crop)
    {
        return view('crops.create-order', compact('crop'));
    }


    public function store(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $totalPrice = $validated['quantity'] * $crop->prices()->latest()->first()->price_per_kg;

        $order = new Order([
            'quantity' => $validated['quantity'],
            'total_price' => $totalPrice,
        ]);

        $order->crop()->associate($crop);
        $order->restaurantOwner()->associate(auth()->user()->restaurantOwner);
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}
