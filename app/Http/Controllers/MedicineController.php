<?php

namespace App\Http\Controllers;


use App\DataTables\MedicinesDataTable;
use App\Http\Requests\StoreMedicineRequest;
use App\Models\Medicine;
use Illuminate\Http\Request;



class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MedicinesDataTable $dataTable)
    {
       return $dataTable->render('medicine.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicineRequest $request)
    {
        Medicine::create($request->validated());
        return to_route('medicines.index')->with('success', 'Area added successfully!')->with('timeout', 5000);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicine = Medicine::where('id', $id)->get();
        return response()->json(['medicine' => $medicine]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         if (is_numeric($id)) {
            $medicine=Medicine::where('id', $id)->first();
            return view('medicine.edit', ['medicine' => $medicine]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMedicineRequest $request, $id)
    {
if (is_numeric($id)) {
    Medicine::where('id', $id)->update($request->validated());
    return to_route('medicines.index')->with('success', 'Area updated successfully!')->with('timeout', 5000);
}
    }


    public function destroy($id)
    {
if (is_numeric($id)) {
    try {
        Medicine::where('id', $id)->delete();
    } catch (\Illuminate\Database\QueryException $exception) {
        return to_route('medicines.index')->with('error', ' you can not delete this medicine because is in order ');
    }
    return to_route('medicines.index');
}
    }
}
