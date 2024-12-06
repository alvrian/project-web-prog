<?php
namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\CompostProducer;
use App\Models\Farmer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Form Data:', $request->all());

        $validated = $request->validate([
            'ProviderID' => 'required|exists:compost_producer,user_id',
            'SubscriberID' => 'required|exists:users,id',
            'ProductableType' => 'required|string',
            'ProductableID' => 'required|exists:compost_entries,id',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after:StartDate',
            'SubscriptionType' => 'required|in:3,6,9,12',
            'Reason' => 'nullable|string',
            'points_used' => 'nullable|numeric',
            'Price' => 'nullable|numeric',
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

        $farmer = Farmer::find(Auth::id());
        if (!$farmer) {
            return back()->withErrors(['Farmer not found for the authenticated user.']);
        }

        $compostProducer = CompostProducer::find($validated['ProviderID']);
        if (!$compostProducer) {
            return back()->withErrors(['Provider not found.']);
        }

        $pointsUsed = $validated['points_used'];

        if ($pointsUsed > 0) {
            $pointsBalance = $farmer->PointsBalance();
            if ($pointsUsed > $pointsBalance) {
                return back()->withErrors(['points_used' => 'You do not have enough points to redeem.']);
            }

            $farmer->PointsBalance -= $pointsUsed;
            $farmer->save();
        }

        $compostProducer->PointsBalance += $pointEarned;
        $compostProducer->save();

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
        return redirect()->route('composters.index')
            ->with('success', 'Subscription created successfully!');

    }
}
