<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\PointsTransaction;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'compost_entry_id' => 'required|exists:compost_entries,id',
            'ProviderID' => 'required|exists:users,id',
            'SubscriberID' => 'required|exists:users,id',
            'subscription_type' => 'required|in:3,6,9,12',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate',
            'points_used' => 'nullable|integer|min:0',
            'Reason' => 'nullable|string|max:255',
            'Products' => 'required|array',
        ]);

        $compostEntry = CompostEntry::with('priceList')->findOrFail($request->compost_entry_id);
        $priceField = 'price_per_subscription_' . $request->subscription_type;

        if (!isset($compostEntry->priceList->$priceField)) {
            return redirect()->back()->withErrors(['error' => 'Invalid subscription type or price unavailable.'])->withInput();
        }

        $price = $compostEntry->priceList->$priceField;
        $user = auth()->user();
        $pointsUsed = $request->points_used ?? 0;

        if ($request->redeem_points && $pointsUsed > 0) {
            if ($pointsUsed > $user->points_balance) {
                return redirect()->back()->withErrors(['error' => 'Insufficient points balance.'])->withInput();
            }
            $price -= $pointsUsed;
            $price = max(0, $price);
        }

        try {
            \DB::transaction(function () use ($request, $compostEntry, $user, $price, $pointsUsed) {
                if ($request->redeem_points && $pointsUsed > 0) {
                    $user->points_balance -= $pointsUsed;
                    $user->save();
                }

                $subscription = Subscription::create([
                    'SubscriberID' => $user->id,
                    'ProviderID' => $compostEntry->compost_producer_id,
                    'SubscriptionType' => (int)$request->subscription_type,
                    'StartDate' => $request->StartDate,
                    'EndDate' => $request->EndDate,
                    'Status' => 'Active',
                    'Reason' => $request->Reason ?? '',
                    'Products' => [$compostEntry->id],
                    'Price' => $price,
                    'PointEarned' => round($price / 10),
                ]);

                if ($subscription->PointEarned > 0) {
                    PointsTransaction::create([
                        'ParticipantID' => $compostEntry->compost_producer_id,
                        'TransactionType' => 'Compost Delivery',
                        'Points' => $subscription->PointEarned,
                        'Description' => "Points earned for compost delivery to Farmer #{$user->id}",
                        'Date' => now(),
                        'Status' => 'Completed',
                    ]);
                }
            });

            return redirect()->route('composters.index')->with('success', 'Subscription created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create subscription: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create subscription.'])->withInput();
        }
    }


}
