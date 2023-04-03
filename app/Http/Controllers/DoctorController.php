<?php

namespace App\Http\Controllers;

use App\DataTables\DoctorsDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class DoctorController extends Controller
{
    public function index(DoctorsDataTable $dataTable)
    {
        $pharmacies = Pharmacy::all();
        $doctors = Doctor::all();
        return $dataTable->render('doctor.index', ['pharmacies' => $pharmacies, 'doctors' => $doctors]);
    }

    public function store(StoreDoctorRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->hasFile('avatar_image')) {
                $avatar = $request->file('avatar_image');
                $avatar_name = $avatar->getClientOriginalName();
                $avatar->storeAs('public/doctors_Images', $avatar_name);
            } else {
                $avatar_name = 'default-avatar.jpg';
            }

            $doctor = Doctor::create([
                'user_id' => $user->id,
                'id' => $request->id,
                'pharmacy_id' => $request->pharmacy_id,
                'is_banned' => $request->has('is_banned') ? 1 : 0,
                'avatar_image' => $avatar_name,
            ]);
            $user->assignRole('doctor');
        } catch (\Illuminate\Database\QueryException $exception) {
            return redirect()->route('doctors.index')->with('error', 'Error in Creating Doctor!')->with('timeout', 5000);
        }
        return redirect()->route('doctors.index')->with('success', 'Doctor has been created successfully!')->with('timeout', 5000);
    }


    public function destroy($id)
    {
        if (is_numeric($id)) {
            try {
                Doctor::where('id', $id)->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('doctors.index')->with('error', 'Delete related records first');
            }
            return to_route('doctors.index')->with('success', 'Doctor has been deleted successfully!')->with('timeout', 5000);
        }
    }

    public function show($id)
    {
        $doctor = Doctor::where('id', $id)->first();
        $pharmacies = Pharmacy::all();
        $userIds = array_merge([$doctor->user_id], $pharmacies->pluck('user_id')->toArray());
        $users = User::whereIn('id', $userIds)->get();
        return response()->json([
            'doctor' => $doctor,
            'pharmacies' => $pharmacies,
            'users' => $users,
        ]);
    }


    public function update(UpdateDoctorRequest $request, $doctor)
    {

        if (is_numeric($doctor)) {
            try {
                $selectedDoctor = Doctor::where('id', $doctor)->firstOrFail();
                $user = $selectedDoctor->user;
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);


                if ($request->hasFile('avatar_image')) {
                    if ($selectedDoctor->avatar_image && $selectedDoctor->avatar_image != 'default-avatar.jpg') {
                        Storage::delete('public/doctors_Images/'.$selectedDoctor->avatar_image);
                    }
                    $avatar = $request->file('avatar_image');
                    $avatar_name = $avatar->getClientOriginalName();
                    $avatar->storeAs('public/doctors_Images', $avatar_name);
                } else {
                    $avatar_name = $selectedDoctor->avatar_image;
                }

                $selectedDoctor->update([
                    'id' => $request->id,
                    'pharmacy_id' => $request->pharmacy_id,
                    'is_banned' => $request->has('is_banned') ? 1 : 0,
                    'avatar_image' => $avatar_name,
                ]);
            } catch (\Illuminate\Database\QueryException $exception) {
                return redirect()->route('doctors.index')->with('error', 'Error in Updating Doctor!')->with('timeout', 5000);
            }
            return redirect()->route('doctors.index')->with('success', 'Doctor has been updated successfully!')->with('timeout', 5000);
        }
    }
}
