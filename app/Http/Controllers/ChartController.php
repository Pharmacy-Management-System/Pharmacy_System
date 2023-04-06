<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function statusData()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $orders = Order::all()->groupBy('status');
        }elseif ($user->hasRole('pharmacy')) {
            $pharmacy = Pharmacy::where('user_id',$user->id)->first()->id;
            $orders = Order::where('pharmacy_id',$pharmacy)->get()->groupBy('status');
        }elseif ($user->hasRole('doctor')) {
            $pharmacy = Doctor::where('user_id',$user->id)->first()->pharmacy_id;
            $orders = Order::where('pharmacy_id',$pharmacy)->get()->groupBy('status');
        }

        $data = [];
        $labels = ['New', 'Processing', 'WaitingForUserConfirmation', 'Canceled', 'Delivered'];
        foreach($labels as $label) {
            if(array_key_exists($label, $orders->toArray())) {
                array_push($data, $orders[$label]->count());
            } else {
                array_push($data, 0);
            }
        }
        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

}