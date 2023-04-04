<?php

namespace App\Http\Controllers;

use App\DataTables\PharmaciesDataTable;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Pharmacy;
use App\Models\Area;
use App\Models\User;
use App\Models\Order;
use App\Models\Doctor;
use App\Models\OrderMedicine;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PharmacyController extends Controller
{
    public function index(PharmaciesDataTable $dataTable)
    {
        $pharmacies = Pharmacy::withTrashed()->get();
        $areas = Area::all();
        return $dataTable->render('pharmacy.index', ['pharmacies' => DataTables::of($pharmacies)->make(true), 'areas' => $areas]);
    }


    public function store(StorePharmacyRequest $request)
    {
        if ($request->hasFile('avatar_image')) {
            $avatar = $request->file('avatar_image');
            $avatar_name = $avatar->getClientOriginalName();
            $avatar->storeAs('public/pharmacies_Images', $avatar_name);
        } else {
            $avatar_name = 'default-avatar.jpg';
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);
        Pharmacy::create([
            'user_id' => $user->id,
            'id' => $request->id,
            'pharmacy_name'=> $request->pharmacy_name,
            'area_id' => $request->area_id,
            'priority' => $request->priority,
            'avatar_image' => $avatar_name
        ])->save();
        $user->assignRole('pharmacy');
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy has been Created Successfully!')->with('timeout', 5000);
    }


    public function destroy($id)
    {
        if (is_numeric($id)) {
            try {
                $orders = Order::where('pharmacy_id', $id)->WhereIn('status', ['Processing','WaitingForUserConfirmation','Confirmed'])->count();
                if($orders){
                    return redirect()->route('pharmacies.index')->with('error', 'ERROR: Failed to Delete Pharmacy, There are Orders Assigned to this Pharmacy');
                }else{
                    $assignedOrders = Order::where('pharmacy_id', $id)->get();
                    $assignedDoctors = Doctor::where('pharmacy_id', $id)->get();

                    foreach($assignedOrders as $assignedOrder){

                        if($assignedOrder){
                            $orderMedicines = OrderMedicine::where('order_id',$assignedOrder->id);
                            foreach($orderMedicines as $orderMedicine){
                                $orderMedicine->delete();
                            }
                            $assignedOrder->delete();
                        }
                    }

                    foreach($assignedDoctors as $assignedDoctor){
                        $assignedDoctor->delete();
                        User::where('email', $assignedDoctor->user->email)->delete();
                    }

                    Pharmacy::where('id', $id)->delete();
                }

            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->back()->with('error', 'ERROR: Failed to Delete, Please Delete The Related Records First');
            }
            return redirect()->back()->with('success', 'Pharmacy has been Deleted Successfully!')->with('timeout', 5000);
        }
    }

    public function restore($pharmacy)
    {
        Pharmacy::withTrashed()->findOrFail($pharmacy)->restore();
        return redirect()->back()->with('success', 'Pharmacy has been Restored Successfully!')->with('timeout', 5000);
    }

    public function show($pharmacy)
    {
        $pharmacy = Pharmacy::where('id', $pharmacy)->first();
        $areas = Area::all();
        $user = User::where('id', $pharmacy->user_id)->first();
        return response()->json([
            'pharmacy' => $pharmacy,
            'areas' => $areas,
            'user' => $user
        ]);
    }

    public function update(UpdatePharmacyRequest $request, $pharmacy)
    {
        if (is_numeric($pharmacy)) {
            try {
                $selectedPharmacy = Pharmacy::where('id', $pharmacy)->firstOrFail();
                $user = $selectedPharmacy->user;
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
                if ($user->hasRole('pharmacy')) {
                    $area = $selectedPharmacy ->area_id;
                    $priority = $selectedPharmacy ->priority;
                }
                else if($user->hasRole('admin')){
                    $area = $request->area_id;
                    $priority = $request->priority;
                }

                if ($request->hasFile('avatar_image')) {
                    if ($selectedPharmacy->avatar_image && $selectedPharmacy->avatar_image != 'default-avatar.jpg') {
                        Storage::delete('public/pharmacies_Images/'.$selectedPharmacy->avatar_image);
                    }
                    $avatar = $request->file('avatar_image');
                    $avatar_name = $avatar->getClientOriginalName();
                    $avatar->storeAs('public/pharmacies_Images', $avatar_name);
                } else {
                    $avatar_name = $selectedPharmacy->avatar_image;
                }

                $selectedPharmacy->update([
                'id' => $request->id,
                'pharmacy_name'=> $request->pharmacy_name,
                'area_id' => $area,
                'priority' => $priority,
                'avatar_image' => $avatar_name,
                ]);


            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('pharmacies.index')->with('error', 'Error in Updating Pharmacy!')->with('timeout', 5000);
            }
            return redirect()->route('pharmacies.index')->with('success', 'Pharmacy has been Updated Successfully!')->with('timeout', 5000);
        }
    }
}