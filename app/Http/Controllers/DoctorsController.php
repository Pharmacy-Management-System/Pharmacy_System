<?php

namespace App\Http\Controllers;
use App\DataTables\DoctorsDataTable;
use App\Http\Requests\StoreDoctorRequest;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index(DoctorsDataTable $dataTable)
    {
        return $dataTable->render('doctors.index');
    }
    public function show(StoreDoctorRequest $request){
        $doctor= $request->where('national_id', $request->national_id)->get();
        return view('doctors.index',['doctor'=>$doctor]);
    }
}
