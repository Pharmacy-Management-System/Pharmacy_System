<?php

namespace App\Http\Controllers;
use App\DataTables\RevenuesDataTable;
use App\Models\Pharmacy;
use App\Models\User;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    public function index(RevenuesDataTable $dataTable)
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return $dataTable->render('revenue.index');
        } elseif ($user->isPharmacy()) {
            $pharmacyData = Pharmacy::where('id', $user->pharmacy_id)->first();
            return view('revenu.index', compact('pharmacyData'));
        }
    }
}
