<?php

namespace App\Http\Controllers;

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
        return $dataTable->render('order.index', ['pharmacies' => Pharmacy::all(), 'doctors' => Doctor::all(), 'medicines' => Medicine::all(), 'users' => User::all(),'clients' => Client::all(),'addresses' => Address::all()]);
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

        $quantity = array_map('intval', $request->quantity);
        $orderMedicine = $request->medicine_id;
        // if( $request->is_insured == null){
        //     $request->is_insured = 0;
        // }

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

        Order::createOrderMedicine($order, $quantity, $orderMedicine);
        $order->price = Order::totalPrice($quantity, $orderMedicine);
        $order->save();


        return to_route('orders.index')->with('success', 'Area created successfully!')->with('timeout', 5000);
    }


    public function show($id)
    {
        $order = Order::with('medicines')->find($id);
        $user = User::find($order->user_id);
        $pharmacy = Pharmacy::find($order->pharmacy_id ?? 1);
        $doctor = Doctor::find($order->doctor_id);
        $doctor_name = User::find($doctor->user_id ?? 1);
        $address = Address::find($order->delivering_address_id);
        $area = Area::find($address->area_id);


        return response()->json([
            'order' => $order,
            'user' => $user,
            'pharmacy' => $pharmacy,
            'doctor' => $doctor,
            'doctor_name'=>$doctor_name,
            'address'=>$address,
            'area'=> $area,
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
            if (!is_null( $request->quantity)) {
                $editedQuantity = array_map('intval', $request->quantity);
            } else {
                $editedQuantity = 0;
            }
            $editedOrderMedicine = $request->medicine_id;
            try {
                $order->update([
                    'user_id' => $request->user_id,
                    'pharmacy_id' => $request->pharmacy_id,
                    'doctor_id' => $request->doctor_id,
                    'creator_type' => $request->creator_type,
                    'status' => $request->status,
                    'is_insured' => $request->has('is_insured') ? 1 : 0,
                    'delivering_address_id' => $request->delivering_address_id ?? null,
                ]);
                Order::updateOrderMedicine($order, $editedQuantity, $editedOrderMedicine);
                $order->price = Order::totalPrice($editedQuantity, $editedOrderMedicine);
                $order->save();
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

}
