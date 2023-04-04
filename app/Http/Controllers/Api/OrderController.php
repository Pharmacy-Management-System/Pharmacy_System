<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Area;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\Pharmacy;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;


class OrderController extends Controller
{
    public function index()
    {
        $client = auth()->user();
        $orders = Order::where('user_id', $client->id)->get();
        return OrderResource::collection($orders);
    }

    public function create(Request $request)
    {
        $client = auth()->user();
        $delivering_address_id = $request->input('delivering_address_id');
        $is_insured = $request->input('is_insured');
        $prescriptions = $request->input('prescriptions');
        $order = new Order([
            'delivering_address_id' => $delivering_address_id,
            'doctor_id'=>null,
            'is_insured' => $is_insured,
            'status'=> "new",
            'creator_type'=>"client",
            'price'=>0,
            'user_id'=> $client->id,
            'pharmacy_id'=>null,
        ]);
        $order->save();
        if ($request->hasFile('prescriptions')) {
            foreach ($request->file('prescriptions') as $prescription) {
                $prescription_name = time() . $prescription->getClientOriginalName();
                $prescription->move(public_path('images/prescriptions'), $prescription_name);
                $order_prescription = new Prescription([
                    'order_id' => $order->id,
                    'image' => $prescription_name,
                ]);
                $order_prescription->save();
            }
        }
        $nat=$client->Client->id;
        $addressAreaId = Address::where('id', $delivering_address_id)->first()->area_id;

        $orders=Order::where('status',"New")->get();
        foreach($orders as $order){
            $order->pharmacy_id=Pharmacy::where('area_id',$addressAreaId)->orderby("priority","desc")->first()->id;
            $order->status="Processing";
            $order->save();
        }

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order
        ], 200);
    }



}
