<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\PickupSchedule;
use Carbon\Carbon;
class RestaurantPickUpSchedule extends Component
{

    public $data;
    public $dataToday;

    public function __construct()
    {
        $user_id = auth()->user()->id;


        // Fetch pickup schedules for the authenticated user
        $this->data = PickupSchedule::where('SenderRestaurantOwnerID', $user_id)
            ->where('Status', 'Scheduled')
            ->orderBy('ScheduledDate', 'asc')
            ->get();

        $today = Carbon::today();

        foreach ($this->data as $item) {
            $item->FormattedScheduledDate = Carbon::parse($item->ScheduledDate)
                ->format('F, d Y, h:i A');
        }
        $this->dataToday = $this->data->filter(function ($item) use ($today) {
            return Carbon::parse($item->ScheduledDate)->toDateString() === $today->toDateString();
        });
    }

    public function render(): View|Closure|string
    {
        return view('components.restaurant-pick-up-schedule', [
            'data' => $this->data,
            'dataToday' => $this->dataToday,
        ]);
    }
}
