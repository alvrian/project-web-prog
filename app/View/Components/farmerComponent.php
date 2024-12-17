<?php

namespace App\View\Components;

use App\Models\CompostProducer;
use App\Models\PickupSchedule;
use Illuminate\View\Component;
use Carbon\Carbon;

class FarmerComponent extends Component
{
    public $pickup;
    public $delivery;

    public function __construct()
    {
        $farmerId = auth()->user()->id;

        // Jadwal Waste Pickup
        $this->pickup = PickupSchedule::with('recipientCompostProducer')
            ->where('SenderFarmerID', $farmerId)
            ->where('PickupType', 'Waste Pickup')
            ->orderBy('ScheduledDate')
            ->get();

        foreach ($this->pickup as $item) {
            $item->FormattedScheduledDate = Carbon::parse($item->ScheduledDate)->format('F, d Y');
            $recipient = $item->recipientCompostProducer;
            $item->RecipientName = $recipient ? $recipient->Name : 'Unknown';
            $item->location = $recipient ? $recipient->Location : 'No Location';
        }

        // Jadwal Compost Delivery
        $this->delivery = PickupSchedule::with('senderCompostProducer')
            ->where('RecipientFarmerID', $farmerId)
            ->where('PickupType', 'Compost Delivery')
            ->orderBy('ScheduledDate')
            ->get();

        foreach ($this->delivery as $item) {
            $item->FormattedScheduledDate = Carbon::parse($item->ScheduledDate)->format('F, d Y');
            $sender = $item->senderCompostProducer;
            $item->RecipientName = $sender ? $sender->Name : 'Unknown';
            $item->location = $sender ? $sender->Location : 'No Location';
        }
    }

    public function render()
    {
        return view('components.farmer-component', [
            'pickup' => $this->pickup,
            'delivery' => $this->delivery
        ]);
    }
}
