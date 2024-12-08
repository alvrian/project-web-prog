<?php

namespace App\Http\Controllers;

use App\Models\CompostEntry;
use App\Models\CompostProducer;
use App\Models\Crop;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
class FarmerController extends Controller
{
    public function index()
    {
        return view("farmerMain");
    }

    public function subscribeToProducers(Request $request)
    {
        $farmer = auth()->user()->farmer;

        if (!$farmer) {
            return redirect()->back()->with('error', 'You do not have access to this section.');
        }

        $request->validate([
            'producer_ids' => 'required|array',
            'producer_ids.*' => 'exists:compost_producer,user_id',
        ]);

        $farmer->compostProducers()->sync($request->producer_ids);

        return redirect()->route('producers.index')->with('success', 'Subscriptions updated successfully.');
    }

    public function details($composterId, $compostId)
    {
        $farmer = Farmer::where('user_id', Auth::id())->firstOrFail();
        $totalPoints = $farmer->totalPoints();

        $compostEntry = CompostEntry::with(['priceList', 'compostProducer'])
            ->where('compost_producer_id', $composterId)
            ->findOrFail($compostId);

        return view('composters.show-detail', compact('compostEntry', 'totalPoints'));
    }


    public function showPoints()
    {
        $farmer = Farmer::where('user_id', Auth::id())->firstOrFail();

        $totalPoints = $farmer->totalPoints();

        return view('farmer.points', compact('totalPoints'));
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
    public function indexFarmer(Request $request)
    {
        $query = Farmer::query();

        if ($request->filled('name')) {
            $query->where('Name', 'like', '%' . $request->input('name') . '%');
        }

        $farmers = $query->get();

        return view('farmers.index', compact('farmers'));
    }

    public function showFarmer($farmerId)
    {
        $farmer = Farmer::findOrFail($farmerId);
        $crops = Crop::where('farmer_id', $farmerId)->get();

        return view('farmers.show', compact('farmer', 'crops'));
    }

    public function detailsFarmer($farmerId, $cropId)
    {
        $user = auth()->user();
        $totalPoints = 0;

        if ($user->role === "restaurant_owner") {
            $totalPoints = $user->restaurantOwner->PointsBalance ?? 0;
        }

        $farmer = Farmer::findOrFail($farmerId);

        $crop = Crop::with('priceList')->findOrFail($cropId);

        return view('farmers.show-detail', compact('farmer', 'crop', 'totalPoints'));
    }

}
