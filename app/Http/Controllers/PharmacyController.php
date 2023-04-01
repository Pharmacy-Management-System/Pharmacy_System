<?php

namespace App\Http\Controllers;

use App\DataTables\PharmaciesDataTable;
use App\Http\Requests\StorePharmacyRequest;
use App\Models\Pharmacy;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
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
            'password' => $request->password,
        ]);
        Pharmacy::create([
            'user_id' => $user->id,
            'id' => $request->id,
            'area_id' => $request->area_id,
            'priority' => $request->priority,
            'avatar_image' => $avatar_name
        ])->save();

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy has been Created Successfully!')->with('timeout', 5000);
    }


    public function destroy($pharmacy)
    {
        if (is_numeric($pharmacy)) {
            try {
                Pharmacy::where('id', $pharmacy)->delete();
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

    public function update(StorePharmacyRequest $request, $pharmacy)
    {
        if (is_numeric($pharmacy)) {
            $pharmacy = Pharmacy::where('id', $pharmacy)->firstOrFail();
            $user = $pharmacy->user;
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $pharmacy->update([
            'id' => $request->id,
            'area_id' => $request->area_id,
            'avatar_image' => $request->avatar,
            'priority' => $request->priority,
            ]);
            return redirect()->route('pharmacies.index')->with('success', 'Pharmacy has been Updated Successfully!')->with('timeout', 5000);
        }
    }
}