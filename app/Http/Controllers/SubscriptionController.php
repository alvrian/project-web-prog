<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\PointsTransaction;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'compost_entry_id' => 'required|exists:compost_entries,id',
            'subscription_type' => 'required|in:3,6,9,12',
            'redeem_points' => 'nullable|boolean',
            'points_used' => 'nullable|integer|min:0',
        ]);

        $compostEntry = CompostEntry::with('priceList')->findOrFail($request->compost_entry_id);
        $priceField = 'price_per_subscription_' . $request->subscription_type;
        $price = $compostEntry->priceList->$priceField;

        if (!$price) {
            return redirect()->back()->withErrors(['error' => 'Invalid subscription type or price unavailable.']);
        }

        $user = auth()->user();
        $pointsUsed = $request->points_used ?? 0;

        if ($request->redeem_points && $pointsUsed > 0) {
            if ($pointsUsed > $user->points_balance) {
                return redirect()->back()->withErrors(['error' => 'Insufficient points balance.']);
            }
            $user->points_balance -= $pointsUsed;
            $user->save();

            $price -= $pointsUsed / 100; // Assuming 1 point = $0.01
            $price = max($price, 0);
        }

        try {
            $subscription = Subscription::create([
                'SubscriberID' => $user->id,
                'ProviderID' => $compostEntry->compost_producer_id,
                'SubscriptionType' => (int)$request->subscription_type,
                'StartDate' => now(),
                'EndDate' => now()->addMonths((int)$request->subscription_type),
                'Status' => 'Active',
                'Reason' => $request->Reason ?? '',
                'Products' => [$compostEntry->id],
                'Price' => $price,
                'PointEarned' => round($price / 10),
            ]);

            return redirect()->route('composters.index')->with('success', 'Subscription created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create subscription: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create subscription.']);
        }
    }


}

