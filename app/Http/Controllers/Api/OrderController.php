<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\AssignNewOrder;
use App\Models\Area;
use App\Models\Prescription;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\OrderResource;


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
        $orders = Order::where('status', "New")->get();
        $client = auth()->user();
        $delivering_address_id = $request->input('delivering_address_id');
        $is_insured = $request->input('is_insured');
        $prescriptions = $request->input('prescriptions');
        $addresses = Address::where('client_id', $client->Client->id)->get();
        if ($addresses->find($delivering_address_id)) {
            if ($request->hasFile('prescriptions')) {
                $order = new Order([
                    'delivering_address_id' => $delivering_address_id,
                    'doctor_id' => null,
                    'is_insured' => $is_insured,
                    'status' => "New",
                    'creator_type' => "client",
                    'price' => 0,
                    'user_id' => $client->id,
                    'pharmacy_id' => null,
                ]);
                $order->save();
                foreach ($request->file('prescriptions') as $prescription) {
                    $prescription_name = 'image-' . $prescription->getClientOriginalName();
                    $prescription->storeAs('public/images/prescriptions', $prescription_name);
                    $order_prescription = new Prescription([
                        'order_id' => $order->id,
                        'image' => $prescription_name,
                    ]);
                    $order_prescription->save();
                }
            } else {
                return response()->json([
                    'message' => 'No prescriptions',
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'address id does not belong to this user',
            ], 400);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'data' => new OrderResource($order)
        ], 200);
    }

    public function show($id)
    {
        $order = Order::find($id);
        $order_prescriptions = Prescription::where('order_id', $id)->get();
        return response()->json([
            'message' => 'Order details',
            'data' => new OrderResource($order),
            'prescriptions' => $order_prescriptions
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order->status == "New") { //New Order
            if ($request->hasFile('prescriptions')) {
                $images = Prescription::where("order_id", $id)->get();
                foreach ($images as $image) {
                    $directory = 'public/images/prescriptions/' . $image->image;
                    Storage::delete($directory);
                }
                Prescription::where("order_id", $id)->delete();
                foreach ($request->file('prescriptions') as $prescription) {
                    $prescription_name = 'image-' . $prescription->getClientOriginalName();
                    $prescription->storeAs('public/images/prescriptions', $prescription_name);
                    $order_prescription = new Prescription([
                        'order_id' => $order->id,
                        'image' => $prescription_name,
                    ]);
                    $order_prescription->save();
                }
            }

        }
        return response()->json([
            'message' => 'Order updated successfully',
            'data' =>new OrderResource($order)
        ], 200);


    }



}
