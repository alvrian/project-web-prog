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
            'ProviderID' => 'required|exists:users,id',
            'SubscriberID' => 'required|exists:users,id',
            'subscription_type' => 'required|in:3,6,9,12',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate',
            'points_used' => 'nullable|integer|min:0',
            'Reason' => 'nullable|string|max:255',
            'ProductableType' => 'required|in:crops,waste_log,compost_entries',
            'ProductableID' => 'required|integer',
        ]);

        $user = auth()->user();
        $pointsUsed = $request->points_used ?? 0;

        $product = null;
        switch ($request->ProductableType) {
            case 'crops':
                $product = \App\Models\Crop::findOrFail($request->ProductableID);
                break;
            case 'waste_log':
                $product = \App\Models\WasteLog::findOrFail($request->ProductableID);
                break;
            case 'compost_entries':
                $product = CompostEntry::findOrFail($request->ProductableID);
                break;
            default:
                return redirect()->back()->withErrors(['error' => 'Invalid product type.'])->withInput();
        }

        $priceField = 'price_per_subscription_' . $request->subscription_type;

        if (!isset($product->priceList->$priceField)) {
            return redirect()->back()->withErrors(['error' => 'Invalid subscription type or price unavailable.'])->withInput();
        }

        $price = $product->priceList->$priceField;

        if ($request->redeem_points && $pointsUsed > 0) {
            if ($pointsUsed > $user->points_balance) {
                return redirect()->back()->withErrors(['error' => 'Insufficient points balance.'])->withInput();
            }
            $price -= $pointsUsed;
            $price = max(0, $price);
        }

        try {
            \DB::transaction(function () use ($request, $user, $product, $price, $pointsUsed) {
                if ($request->redeem_points && $pointsUsed > 0) {
                    $user->points_balance -= $pointsUsed;
                    $user->save();
                }

                $subscription = Subscription::create([
                    'SubscriberID' => $user->id,
                    'ProviderID' => $request->ProviderID,
                    'SubscriptionType' => (int)$request->subscription_type,
                    'StartDate' => $request->StartDate,
                    'EndDate' => $request->EndDate,
                    'Status' => 'Active',
                    'Reason' => $request->Reason ?? '',
                    'ProductableType' => $request->ProductableType,
                    'ProductableID' => $product->id,
                    'Price' => $price,
                    'PointEarned' => round($price / 10),
                ]);

               if ($subscription->PointEarned > 0) {
                    PointsTransaction::create([
                        'ParticipantID' => $request->ProviderID,
                        'TransactionType' => 'Subscription Delivery',
                        'Points' => $subscription->PointEarned,
                        'Description' => "Points earned for subscription by Farmer #{$user->id}",
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
