<?php

namespace App\View\Components;

use App\Models\Subscription;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;
class farmerSubscription extends Component
{
    /**
     * Create a new component instance.
     */
    public $data;

    public function __construct()
    {   
        $id = auth()->user()->id;
        $this->data = Subscription::where('SubscriberID', $id) ->where('Status', '<>', 'Expired')->get();
        foreach ($this->data as $item) {
            $provider = User::where('id', $item->ProviderID)->first();
            $item->providerName = $provider->name;
            $item->providerEmail = $provider->email;
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.farmer-subscription', [
            "data" => $this->data
        ]);
    }
}
