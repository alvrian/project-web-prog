<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\CompostEntry;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'compost_entry_id' => 'required|exists:compost_entries,id',
            'subscription_type' => 'required|in:3,6,9,12',
        ]);

        $compostEntry = CompostEntry::with('priceList')->findOrFail($request->compost_entry_id);

        $priceField = 'price_per_subscription_' . $request->subscription_type;
        $price = $compostEntry->priceList->$priceField;

        if (!$price) {
            return redirect()->back()->withErrors(['error' => 'Invalid subscription type or price unavailable.']);
        }

        $subscription = Subscription::create([
            'SubscriberID' => auth()->id(),
            'ProviderID' => $compostEntry->compost_producer_id,
            'SubscriptionType' => $request->subscription_type,
            'StartDate' => Carbon::now(),
            'EndDate' => Carbon::now()->addMonths($request->subscription_type),
            'Status' => 'Active',
            'Reason' => null,
            'Price' => $price,
            'PointEarned' => round($price / 10),
        ]);

        return redirect()->back()->with('success', 'Subscription created successfully!');
    }
}

