<?php
namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\CompostProducer;
use App\Models\Crop;
use App\Models\Farmer;
use App\Models\RestaurantOwner;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function storeFarmerSubscribeCompost(Request $request)
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
        $price = $validated['Price'];
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

    public function storeROSubscribeFarmer(Request $request)
    {
        Log::info('Form Data:', $request->all());

        $validated = $request->validate([
            'ProviderID' => 'required|exists:farmer,user_id',
            'SubscriberID' => 'required|exists:users,id',
            'ProductableType' => 'required|string',
            'ProductableID' => 'required|exists:crops,id',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after:StartDate',
            'SubscriptionType' => 'required|in:3,6,9,12',
            'Reason' => 'nullable|string',
            'Price' => 'nullable|numeric',
        ]);

        $crop = Crop::with('priceList')->findOrFail($validated['ProductableID']);
        $price = $validated['Price'];
        $pointEarned = $price * 0.10;

        $restaurantOwner = RestaurantOwner::find(Auth::id());
        if (!$restaurantOwner) {
            return back()->withErrors(['Restaurant Owner not found for the authenticated user.']);
        }

        $farmer = Farmer::find($validated['ProviderID']);
        if (!$farmer) {
            return back()->withErrors(['Provider not found.']);
        }

        $pointsUsed = $validated['points_used'] ?? 0;
        if ($pointsUsed > 0) {
            $pointsBalance = $restaurantOwner->PointsBalance();
            if ($pointsUsed > $pointsBalance) {
                return back()->withErrors(['points_used' => 'You do not have enough points to redeem.']);
            }

            $restaurantOwner->PointsBalance -= $pointsUsed;
            $restaurantOwner->save();
        }

        $farmer->PointsBalance += $pointEarned;
        $farmer->save();
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


        return redirect()->route('farmers.index')
            ->with('success', 'Crop subscription created successfully!');
    }


}
