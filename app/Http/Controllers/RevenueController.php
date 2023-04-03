<?php

namespace App\Http\Controllers;
use App\DataTables\RevenuesDataTable;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index(RevenuesDataTable $dataTable)
    {
       return $dataTable->render('revenue.index');
    }
}