<?php

namespace App\Http\Controllers;

use App\Models\PickupSchedule;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {   
        $id = auth()->user()->id;
        $data = Subscription::where('SubscriberID', $id) ->where('Status', '<>', 'Expired')->get();

        foreach ($data as $item) {
            $provider = User::where('id', $item->ProviderID)->first();
            // dd($provider);
            $item->providerName = $provider->name;
            $item->providerEmail = $provider->email;
        }

        return view("restaurantMain", compact("data"));
    }

    public function subsManagementResume(Request $req){
        $temp = Subscription::where("SubscriptionID", $req->subscriptionID)->first();
        $temp->update([
            "Status" => "Active"
        ]);
        return redirect()->back();
    }

    public function subsManagementPause(Request $req){
        $temp = Subscription::where("SubscriptionID", $req->subscriptionID)->first();
        // dd($req);
        $temp->update([
            "Status" => "Postponed"
        ]);

        return redirect()->back();
    }

    public function subsManageCancel(Request $req)
    {
        $subscription = Subscription::findOrFail($req->subscriptionID);
        
        $subscription->delete();

        return redirect()->back()->with('success', 'Subscription has been canceled');
    }

}
