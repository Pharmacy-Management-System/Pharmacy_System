<?php

namespace App\Http\Controllers;

use App\DataTables\AreasDataTable;
use App\Models\Area;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AreaController extends Controller
{
    public function index(AreasDataTable $dataTable)
    {
        //dd($dataTable);
        return $dataTable->render('index');
    }
}
