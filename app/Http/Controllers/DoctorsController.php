<?php

namespace App\Http\Controllers;
use App\DataTables\DoctorsDataTable;

use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index(DoctorsDataTable $dataTable)
    {
        return $dataTable->render('doctors.index');
    }
}
