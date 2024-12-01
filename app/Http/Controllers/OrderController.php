<?php
namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
