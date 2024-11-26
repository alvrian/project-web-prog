<?php

namespace App\Http\Controllers;
use App\Models\PointsTransaction;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index (){
        return view ("accountMain");
    }

    public function point(){
        // $user = auth()->user();
        // dd($user);

        $id = 10; //change later to account id
        $data = PointsTransaction::where('ParticipantID', $id)->orderBy('Date', 'desc')->get();

        $earn = $data->where('TransactionType', 'Earned')->where('Status', 'Completed')->sum('Points');
        $spend = $data->where('TransactionType', 'Redeemed')->where('Status', 'Completed')->sum('Points');
        $total = $earn - $spend;
        $total = number_format($total, 2, '.', ',');
            
        $completed = $data->whereIn('Status', ['Completed', 'Failed']);
        $pending = $data->where('Status', 'Pending');

        return view('accountPoints', compact('completed', 'total', 'pending'));
    }

}
