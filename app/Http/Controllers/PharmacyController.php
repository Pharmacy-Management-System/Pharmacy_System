<?php

namespace App\Http\Controllers;

use App\DataTables\PharmaciesDataTable;
use App\Http\Requests\StorePharmacyRequest;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PharmacyController extends Controller
{
    public function index(PharmaciesDataTable $dataTable)
    {
        return $dataTable->render('pharmacy.index');
    }

    public function destroy($pharmacy)
    {
        if (is_numeric($pharmacy)) {
            try {
                Pharmacy::where('id', $pharmacy)->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('pharmacies.index')->with('error', 'Delete related records first');
            }
            return to_route('pharmacies.index')->with('success', 'Pharmacy Deleted Successfully!');
        }
    }

    // public function show($area_id)
    // {
    //     $area = Area::where('area_id', $area_id)->get();
    //     return response()->json(['area' => $area]);
    // }

    // public function update(StorePharmacyRequest $request, $area_id)
    // {
    //     if (is_numeric($area_id)) {
    //         Area::where('area_id', $area_id)->update($request->validated());
    //         return to_route('areas.index');
    //     }
    // }

    public function edit($pharmacy)
    {
        if (is_numeric($pharmacy)) {
            $pharmacy = Pharmacy::where('id', $pharmacy)->first();
            return view('pharmacies.edit', ['pharmacy' => $pharmacy]);
        }
    }
}
