<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\RestaurantOwner;
use App\Models\Farmer;
use App\Models\CompostProducer;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($validated['role'] === 'restaurant_owner'){
            RestaurantOwner::create([
                'user_id' => $user->id,
                'Name' => $user->name,
                // 'Location' => 'test',
                'Type' => 'Restaurant',
                'AverageFoodWastePerMonth' => 0,
                'AmountBalance' => 0
            ]);
        }

        if($validated['role'] === 'farmer'){
            Farmer::create([
                'user_id' => $user->id,
                'Name' => $user->name,
                // 'Location' => 'test',
                // 'CropTypesProduced' => 'test',
                // 'HarvestSchedule' => '2024-01-01',
                // 'AverageCropAmount' => 0,
                'PointsBalance' => 0,
                'AmountBalance' => 0,
            ]);
        }

        if($validated['role'] === 'compost_producer'){
            CompostProducer::create([
                'user_id' => $user->id,
                'Name' => $user->name,
                'Location' => 'test',
                // 'CompostTypesProduced' => 'test',
                // 'AverageCompostAmountPerTerm' => 0,
                // 'WasteProcessingCapacity' => 0,
                'PointsBalance' => 0,
                'AmountBalance' => 0
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('account', absolute: false));
    }
}
