<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Address;
use App\Models\Area;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\OrderMedicine;
use App\Models\Pharmacy;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use App\Http\Requests\StoreOrderRequest;
use App\Jobs\OrderConfirmationJob;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('order.index', ['pharmacies' => Pharmacy::all(), 'doctors' => Doctor::all(), 'medicines' => Medicine::all(), 'users' => User::all(), 'clients' => Client::all(), 'addresses' => Address::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(StoreOrderRequest $request)
    {
        $client = Client::where("user_id", "=", $request->user_id)->first();
        $pharmacy = Pharmacy::find($request->pharmacy_id);
        if ($client->address->find($request->delivering_address_id)) {
            if ($request->doctor_id == null || $pharmacy->doctors->find($request->doctor_id)) {
                $quantity = array_map('intval', $request->quantity);
                $orderMedicine = $request->medicine_id;
                $order = Order::create([
                    'user_id' => $request->user_id,
                    'pharmacy_id' => $request->pharmacy_id,
                    'doctor_id' => $request->doctor_id,
                    'creator_type' => $request->creator_type,
                    'status' => $request->status,
                    'is_insured' => $request->has('is_insured') ? 1 : 0,
                    'delivering_address_id' => $request->delivering_address_id,
                    'price' => 0,
                ]);
                try {
                    Order::createOrderMedicine($order, $quantity, $orderMedicine);
                    $order->price = Order::totalPrice($quantity, $orderMedicine);
                    $order->save();
                    if ($order->status == "WaitingForUserConfirmation") {
                        $user = User::where('id', '=', $order->user_id)->first();
                        dispatch(new OrderConfirmationJob($user, $order));
                    }
                } catch (\ErrorException $e) {
                    return redirect()->route('orders.index')->with('error', 'Error there is no medicine with this name !')->with('timeout', 5000);
                }
                return to_route('orders.index')->with('success', 'Order created successfully!')->with('timeout', 5000);
            } else {
                return to_route('orders.index')->with('error', 'The selected doctor does not work in this pharmacy, Please choose the correct doctor!');
            }
        } else {
            return to_route('orders.index')->with('error', 'Delivery address doesn\'t belong to this client!');
        }
    }





    public function show($id)
    {
        $order = Order::with('medicines')->find($id);
        $user = User::find($order->user_id);
        $pharmacy = Pharmacy::find($order->pharmacy_id);
        $doctor = Doctor::find($order->doctor_id);
        $doctor_name = User::find($doctor->user_id ?? 1);
        $address = Address::find($order->delivering_address_id);
        $area = Area::find($address->area_id);
        $prescriptions = Prescription::where('order_id', $order->id)->get();


        return response()->json([
            'order' => $order,
            'user' => $user,
            'pharmacy' => $pharmacy,
            'doctor' => $doctor,
            'doctor_name' => $doctor_name,
            'address' => $address,
            'area' => $area,
            'doctor_name' => $doctor_name,
            'address' => $address,
            'area' => $area,
            'prescriptions' => $prescriptions
        ]);
    }

    public function edit($id)
    {
        $order = Order::with('medicines')->find($id);
        $user = User::find($order->user_id);
        $pharmacy = Pharmacy::find($order->pharmacy_id);
        $doctor = Doctor::find($order->doctor_id);
        return view('order.edit', ['order' => $order, 'user' => $user, 'pharmacy' => $pharmacy, 'doctor' => $doctor]);
    }

    public function update(StoreOrderRequest $request, $id)
    {
        if (is_numeric($id)) {
            $order = Order::find($id);
            if (!is_null($request->quantity)) {
                $editedQuantity = array_map('intval', $request->quantity);
            } else {
                $editedQuantity = 0;
            }
            $editedOrderMedicine = $request->medicine_id;
            try {
                $order->update([
                    'doctor_id' => $request->doctor_id,
                    'status' => 'WaitingForUserConfirmation',
                ]);
                try {
                    Order::updateOrderMedicine($order, $editedQuantity, $editedOrderMedicine);
                    $order->price = Order::totalPrice($editedQuantity, $editedOrderMedicine);
                    $order->save();
                    if ($order->status == "WaitingForUserConfirmation") {
                        $user = User::where('id', '=', $order->user_id)->first();
                        dispatch(new OrderConfirmationJob($user, $order));
                    }
                } catch (\ErrorException $e) {
                    return redirect()->route('orders.index')->with('error', 'Error there is no medicine with this name !')->with('timeout', 5000);
                }
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('orders.index')->with('error', 'Error in Updating Order!')->with('timeout', 5000);
            }
            return redirect()->route('orders.index')->with('success', 'Orders has been updated successfully!')->with('timeout', 5000);
        }
    }

    public function destroy($id)
    {
        $order = Order::with('medicines')->find($id);
        $order->medicines()->detach();
        Prescription::where("order_id", $id)->delete();
        $order->delete();
        return to_route('orders.index')->with('success', 'order deleted successfully!')->with('timeout', 5000);
    }

    public function updatestatus($order_id)
    {
        if (is_numeric($order_id)) {

            $order = Order::where('id', $order_id)->first();
            if ($order->status == "WaitingForUserConfirmation") {
                $order->update([
                    "status" =>  "Canceled"
                ]);
                return view('actions.cancel', ['order' => $order, 'state' => "WaitingForUserConfirmation"]);
            } elseif ($order->status == "Canceled") {
                return view('actions.cancel', ['order' => $order, 'state' => "Canceled"]);
            } elseif ($order->status == "Confirmed" || $order->status == "Delivered") {
                return view('actions.cancel', ['order' => $order, 'state' => "Confirmed"]);
            }
        }
    }
}
