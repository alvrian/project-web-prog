<?php

namespace App\Http\Controllers;

use App\Models\PickupSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $data = PickupSchedule::where('SenderRestaurantOwnerID', $user_id)->where('Status', 'Scheduled')->orderBy('ScheduledDate', 'asc')->get();
        $today = Carbon::today();

        foreach ($data as $item) {
            $item->FormattedScheduledDate = Carbon::parse($item->ScheduledDate)->format('F, d Y, h:i A');
        }

        $dataToday = $data->filter(function ($item) use ($today) {
            return Carbon::parse($item->ScheduledDate)->toDateString() === $today->toDateString();
        });
        return view("restaurantMain", compact("data", "dataToday"));
    }
}
