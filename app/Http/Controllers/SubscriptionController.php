<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Form Data:', $request->all());

        $validated = $request->validate([
            'ProviderID' => 'required|exists:compost_producer,id',
            'SubscriberID' => 'required|exists:users,id',
            'ProductableType' => 'required|string',
            'ProductableID' => 'required|exists:compost_entries,id',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after:StartDate',
            'SubscriptionType' => 'required|in:3,6,9,12',
            'Reason' => 'nullable|string',
            'points_used'=>'nullable|numeric',
            'Price'=>'nullable|numeric',
        ]);

        $compostEntry = CompostEntry::findOrFail($validated['ProductableID']);
        $priceList = $compostEntry->priceList;

        $prices = [
            3 => $priceList->price_per_subscription_3 ?? null,
            6 => $priceList->price_per_subscription_6 ?? null,
            9 => $priceList->price_per_subscription_9 ?? null,
            12 => $priceList->price_per_subscription_12 ?? null,
        ];

        $price = $prices[$validated['SubscriptionType']] ?? null;

        if (!$price) {
            return back()->withErrors(['SubscriptionType' => 'Invalid subscription type or price unavailable.']);
        }

        $pointEarned = $price * 0.10;
        $reason = $request->reason ?? '';

        $subscription = Subscription::create([
            'ProviderID' => $validated['ProviderID'],
            'SubscriberID' => $validated['SubscriberID'],
            'ProductableType' => $validated['ProductableType'],
            'ProductableID' => $validated['ProductableID'],
            'StartDate' => $validated['StartDate'],
            'EndDate' => $validated['EndDate'],
            'Price' => $validated['Price'],
            'Status' => 'Active',
            'Reason' => $reason,
            'PointEarned' => $pointEarned,
            'SubscriptionType' => $validated['SubscriptionType'],
        ]);

        return redirect()->route('composters.index', ['id' => $validated['ProductableID']])
            ->with('success', 'Subscription created successfully!');
    }


}
