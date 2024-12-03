<?php

namespace App\View\Components;

use App\Models\CompostProducer;
use App\Models\Farmer;
use App\Models\PickupSchedule;
use App\Models\RestaurantOwner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Carbon\Carbon;

class CompostProducerComponent extends Component
{
    public $pickup;
    public $delivery;

    public function __construct()
    {
        $user_id = auth()->user()->id;
        $this->delivery = PickupSchedule::where("PickupType", "Compost Delivery")->where("SenderCompostProducerID", $user_id)->get();
        foreach ($this->delivery as $item) {
            $temp = null;

            $item->FormattedScheduledDate = Carbon::parse($item->ScheduledDate)->format('F, d Y, h:i A');
            if($item->RecipientRestaurantOwnerID){
                $id = $item->RecipientRestaurantOwnerID;
                $temp = RestaurantOwner::where('user_id', $id)->first();
            }elseif($item->RecipientCompostProducerID){
                $id = $item->RecipientCompostProducerID;
                $temp = CompostProducer::where('user_id', $id)->first();
            }elseif($item->RecipientFarmerID){
                $id = $item->RecipientFarmerID;
                $temp = Farmer::where('user_id', $id)->first();
            }
            $item->RecipientName = $temp->Name;
            $item->location = $temp->Location;
        }
        $this->pickup = PickupSchedule::where("PickupType", "Waste Pickup")->where("RecipientCompostProducerID", $user_id)->get();
        foreach ($this->pickup as $item) {
            $item->FormattedScheduledDate = Carbon::parse($item->ScheduledDate)->format('F, d Y, h:i A');
            $temp = null;

            if($item->SenderRestaurantOwnerID){
                $id = $item->SenderRestaurantOwnerID;
                $temp = RestaurantOwner::where('user_id', $id)->first();
            }elseif($item->SenderCompostProducerID){
                $id = $item->SenderCompostProducerID;
                $temp = CompostProducer::where('user_id', $id)->first();
            }elseif($item->SenderFarmerID){
                $id = $item->SenderFarmerID;
                $temp = Farmer::where('user_id', $id)->first();
            }
            $item->RecipientName = $temp->Name;
            $item->location = $temp->Location;
        }
        // dd($this->delivery);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.compost-producer-component', [
            "delivery" => $this->delivery,
            "pickup" => $this->pickup
        ]);
    }
}
