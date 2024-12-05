<?php

namespace App\Http\Controllers;

use App\Models\PickupSchedule;
use App\Models\User;
use Illuminate\Http\Request;

class CompostController extends Controller
{
    public function index()
    {
        return view("compostMain");
    }

    public function schedule(Request $req)
    {
        $temp = User::where('email', $req->email)->first();
        if(!$temp){
            return redirect()->back()->with('failed', 'No Account found');
        }
        $id = $temp->id;
        if ($temp && $temp->role !== $req->RecipientType) {
            return redirect()->back()->with('failed', 'Role mismatch. Please check the Recipient Type');
        }

        if ($req->type == "Waste Pickup") {
            if ($req->RecipientType == "compost_producer") {
                PickupSchedule::create([
                    "SenderCompostProducerID" => $id,
                    "RecipientCompostProducerID" => auth()->user()->id,
                    "PickupType" => "Waste Pickup",
                    "ScheduledDate" => $req->date,
                    'Status' => "Scheduled"
                ]);
            } elseif ($req->RecipientType == "farmer") {
                PickupSchedule::create([
                    "SenderFarmerID" => $id,
                    "RecipientCompostProducerID" => auth()->user()->id,
                    "PickupType" => "Waste Pickup",
                    "ScheduledDate" => $req->date,
                    'Status' => "Scheduled"
                ]);
            } elseif ($req->RecipientType == "restaurant_owner") {
                PickupSchedule::create([
                    "SenderRestaurantOwnerID" => $id,
                    "RecipientCompostProducerID" => auth()->user()->id,
                    "PickupType" => "Waste Pickup",
                    "ScheduledDate" => $req->date,
                    'Status' => "Scheduled"
                ]);
            }
        } elseif ($req->type = "Compost Delivery") {
            if ($req->RecipientType == "compost_producer") {
                PickupSchedule::create([
                    "RecipientCompostProducerID" => $id,
                    "SenderCompostProducerID" => auth()->user()->id,
                    "PickupType" => "Compost Delivery",
                    "ScheduledDate" => $req->date,
                    'Status' => "Scheduled"
                ]);
            } elseif ($req->RecipientType == "farmer") {
                PickupSchedule::create([
                    "RecipientFarmerID" => $id,
                    "SenderCompostProducerID" => auth()->user()->id,
                    "PickupType" => "Compost Delivery",
                    "ScheduledDate" => $req->date,
                    'Status' => "Scheduled"
                ]);
            } elseif ($req->RecipientType == "restaurant_owner") {
                PickupSchedule::create([
                    "RecipientRestaurantOwnerID" => $id,
                    "SenderCompostProducerID" => auth()->user()->id,
                    "PickupType" => "Compost Delivery",
                    "ScheduledDate" => $req->date,
                    'Status' => "Scheduled"
                ]);
            }
        }
        return redirect()->route('compost.home')->with('success', 'a new schedule has been added');
    }
}
