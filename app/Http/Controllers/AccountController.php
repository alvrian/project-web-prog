<?php

namespace App\Http\Controllers;

use App\Models\PointsTransaction;
use App\Models\RestaurantOwner;
use App\Models\Farmer;
use App\Models\CompostProducer;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $id = $user->id;
        $temp = null;
        if ($user->role == "compost_producer") {
            $temp = CompostProducer::where('user_id', $id)->first();
        } elseif ($user->role == "farmer") {
            $temp = Farmer::where('user_id', $id)->first();
        } elseif ($user->role == "restaurant_owner") {
            $temp = RestaurantOwner::where('user_id', $id)->first();
        }
        $tempArray = $temp->toArray();
        $is_null = false;
        foreach ($tempArray as $key => $value) {
            if (is_null($value)) {
                $is_null = true;
                break;
            }
        }

        $data = PointsTransaction::where('ParticipantID', $id)->orderBy('Date', 'desc')->get();
        $earn = $data->where('TransactionType', 'Earned')->where('Status', 'Completed')->sum('Points');
        $spend = $data->where('TransactionType', 'Redeemed')->where('Status', 'Completed')->sum('Points');
        $total = $earn - $spend;
        $total = number_format($total, 2, '.', ',');


        return view("accountMain", compact('total', 'data', 'is_null'));
    }

    public function point()
    {
        $user = auth()->user();

        $id = $user->id; //change later to account id
        $data = PointsTransaction::where('ParticipantID', $id)->orderBy('Date', 'desc')->get();

        $earn = $data->where('TransactionType', 'Earned')->where('Status', 'Completed')->sum('Points');
        $spend = $data->where('TransactionType', 'Redeemed')->where('Status', 'Completed')->sum('Points');
        $total = $earn - $spend;
        $total = number_format($total, 2, '.', ',');

        $completed = $data->whereIn('Status', ['Completed', 'Failed']);
        $pending = $data->where('Status', 'Pending');

        return view('accountPoints', compact('completed', 'total', 'pending'));
    }

    public function complete(Request $res)
    {
        $user = auth()->user();
        $id = $user->id;
        $role = $user->role;

        if ($role == "farmer") {
            $temp = Farmer::where('user_id', $id)->first();
            $temp->update([
                'Location' => $res->location,
                'CropTypesProduced' => $res->CropTypesProduced,
                'HarvestSchedule' => $res->DayOfWeek,
                'AverageCropAmount' =>  $res->AverageCropAmount
            ]);
        } elseif ($role == "compost_producer") {
            $temp = CompostProducer::where('user_id', $id)->first();
            // dd($res);
            $temp->update([
                'Location' => $res->location,
                'CompostTypesProduced' => $res->CompostTypesProduced,
                'AverageCompostAmountPerTerm' => $res->Average,
                'WasteProcessingCapacity' =>  $res->capacity
            ]);
        } elseif ($role == "restaurant_owner") {
            $temp = RestaurantOwner::where('user_id', $id)->first();

            $temp->update([
                'Location' => $res->location
            ]);
        } else {
            return response()->json(['error' => 'Farmer not found'], 404);
        }

        return redirect()->route('home');
    }
}
