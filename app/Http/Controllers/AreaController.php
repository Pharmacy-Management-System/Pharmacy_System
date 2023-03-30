<?php

namespace App\Http\Controllers;

use App\DataTables\AreasDataTable;
use App\Http\Requests\StoreAreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AreaController extends Controller
{
    public function index(AreasDataTable $dataTable)
    {
        //dd($dataTable);
        return $dataTable->render('areas.index');
    }

    public function destroy($area_id)
    {
        if (is_numeric($area_id)) {
            try {
                Area::where('area_id', $area_id)->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('areas.index')->with('error', 'Delete related records first');
            }
            return to_route('areas.index');
        }
    }

    public function show($area_id)
    {
        $area = Area::where('area_id', $area_id)->get();
        return response()->json(['area' => $area]);
    }

    public function store(StoreAreaRequest $request)
    {
        Area::create($request->validated());
        return to_route('areas.index')->with('success', 'Area added successfully!')->with('timeout', 5000);
    }
    public function update(StoreAreaRequest $request, $area_id)
    {
        if (is_numeric($area_id)) {
            try {
                Area::where('area_id', $area_id)->update($request->validated());
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('areas.index')->with('error', 'Cannot update a postal code for this areaa because of relation with other records ');
            }
            return to_route('areas.index')->with('success', 'Area updated successfully!')->with('timeout', 5000);
        }        
    }
    public function edit($area_id)
    {
        if (is_numeric($area_id)) {
            $area=Area::where('area_id', $area_id)->first();
            return view('areas.edit', ['area' => $area]);
        }
    }
}
