<?php

namespace App\Http\Controllers;

use App\DataTables\AreasDataTable;
use App\Http\Requests\StoreAreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class AreaController extends Controller
{
    public function index(AreasDataTable $dataTable)
    {
        $countries = DB::table('countries')->get();
        return $dataTable->render('area.index',['countries' => $countries]);
    }

    public function destroy($area)
    {
        if (is_numeric($area)) {
            try {
                Area::where('id', $area)->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('areas.index')->with('error', 'ERROR: Failed to Delete, Please Delete The Related Records First');
            }
            return to_route('areas.index');
        }
    }

    public function show($id)
    {
        $area = Area::where('id', $id)->get();
        $countries = DB::table('countries')->get();
        return response()->json([
            'area' => $area,
            'countries' => $countries
        ]);
    }

    public function store(StoreAreaRequest $request)
    {
        Area::create($request->validated());
        return to_route('areas.index')->with('success', 'Area has been Added Successfully!')->with('timeout', 5000);
    }
    public function update(StoreAreaRequest $request, $area)
    {
        if (is_numeric($area)) {
            try {
                Area::where('id', $area)->update($request->validated());
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('areas.index')->with('error', 'Error in Updating Area!');
            }
            return to_route('areas.index')->with('success', 'Area has been Updated Successfully!')->with('timeout', 5000);
        }
    }

}