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
            Area::where('area_id', $area_id)->delete();
            return to_route('areas.index');
        }
    }

    public function show($area_id)
    {

        $area = Area::where('area_id', $area_id)->get();
        return response()->json(['area' => $area]);
    }

    public function update(StoreAreaRequest $request, $area_id)
    {
        dd($request);
    }
    public function edit($area_id)
    {
        if (is_numeric($area_id)) {
            $area=Area::where('area_id', $area_id)->first();
            return view('areas.edit', ['area' => $area]);
        }
    }
}
