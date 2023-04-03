<?php

namespace App\Http\Controllers;

use App\DataTables\PharmaciesDataTable;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Pharmacy;
use App\Models\Area;
use App\Models\User;
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
                Pharmacy::where('id', $id)->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->back()->with('error', 'Delete related records first');
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
                $pharmacy = Pharmacy::where('id', $pharmacy)->firstOrFail();
                $user = $pharmacy->user;
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                if ($request->hasFile('avatar_image')) {
                    if ($pharmacy->avatar_image && $pharmacy->avatar_image != 'default-avatar.jpg') {
                        Storage::delete('public/pharmacies_Images/'.$pharmacy->avatar_image);
                    }
                    $avatar = $request->file('avatar_image');
                    $avatar_name = $avatar->getClientOriginalName();
                    $avatar->storeAs('public/pharmacies_Images', $avatar_name);
                } else {
                    $avatar_name = $pharmacy->avatar_image;
                }

                $pharmacy->update([
                'id' => $request->id,
                'pharmacy_name'=> $request->pharmacy_name,
                'area_id' => $request->area_id,
                'avatar_image' => $avatar_name,
                'priority' => $request->priority,
                ]);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('pharmacies.index')->with('error', 'Error in Updating Doctor!')->with('timeout', 5000);
            }
            return redirect()->route('pharmacies.index')->with('success', 'Pharmacy has been Updated Successfully!')->with('timeout', 5000);
        }
    }
}
