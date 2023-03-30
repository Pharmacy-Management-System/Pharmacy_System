<?php

namespace App\Http\Controllers;

use App\DataTables\DoctorsDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDoctorRequest;
use App\Models\Doctor;
use App\Models\Pharmacy;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class DoctorsController extends Controller
{
    public function index(DoctorsDataTable $dataTable)
    {
        $pharmacies = Pharmacy::all();
        return $dataTable->render('doctors.index', ['pharmacies' => $pharmacies]);
    }



    public function destroy($national_id)
    {
        if (is_numeric($national_id)) {
            try {
                Doctor::where('national_id', $national_id)->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('doctors.index')->with('error', 'Delete related records first');
            }
            return to_route('doctors.index');
        }
    }

    public function show($national_id)
    {
        $doctor = Doctor::where('national_id', $national_id)->get();
        return response()->json(['doctor' => $doctor]);
    }
    public function update(StoreDoctorRequest $request, $national_id)
    {
        if (is_numeric($national_id)) {
            Doctor::where('national_id', $national_id)->update([
            'national_id' => $request->national_id,
            'pharmacy_id' => $request->pharmacy_id,
            'is_banned' => $request->is_banned,
            'avatar' => $request->avatar,
            ]);
            return redirect()->route('doctors.index');
        }
    }



    public function edit($national_id)
    {
        if (is_numeric($national_id)) {
            $doctor = Doctor::where('national_id', $national_id)->first();
            return view('doctors.edit', ['doctor' => $doctor]);
        }
    }
}
