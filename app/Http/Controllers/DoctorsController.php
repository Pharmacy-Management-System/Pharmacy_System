<?php

namespace App\Http\Controllers;

use App\DataTables\DoctorsDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDoctorRequest;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class DoctorsController extends Controller
{
    public function index(DoctorsDataTable $dataTable)
    {
        $pharmacies = Pharmacy::all();
        $doctors = Doctor::all();
        return $dataTable->render('doctors.index', ['pharmacies' => $pharmacies,'doctors'=>$doctors]);
    }

    public function store(StoreDoctorRequest $request)
    {
        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Create a new doctor record
        $doctor = Doctor::create([
            'user_id' => $user->id,
            'id' => $request->id,
            'pharmacy_id' => $request->pharmacy_id,
            'is_banned' => $request->is_banned,
            'avatar' => $request->avatar,
        ]);

        return redirect()->route('doctors.index',['pharmacies'=> Pharmacy::all(), 'users'=>User::all()])->with('success', 'Doctor has been created!');
    }




    public function destroy($id)
    {
        if (is_numeric($id)) {
            try {
                Doctor::where('id', $id)->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('doctors.index')->with('error', 'Delete related records first');
            }
            return to_route('doctors.index');
        }
    }



    public function show($id)
    {
        $doctor = Doctor::where('id', $id)->get();
        $pharmacies = Pharmacy::all();
        $users = User::all();
        return response()->json([
            'doctor' => $doctor,
            'pharmacies' => $pharmacies,
            'users' => $users,
        ]);
    }



    public function update(StoreDoctorRequest $request, $id)
    {
        if (is_numeric($id)) {
            $doctor = Doctor::where('id', $id)->firstOrFail();
            $user = $doctor->user;
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $doctor->update([
            'id' => $request->id,
            'pharmacy_id' => $request->pharmacy_id,
            'is_banned' => $request->is_banned,
            'avatar' => $request->avatar,
            ]);
            return redirect()->route('doctors.index');
        }
    }
}
