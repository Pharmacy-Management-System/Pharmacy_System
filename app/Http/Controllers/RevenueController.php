<?php

namespace App\Http\Controllers;
use App\DataTables\RevenuesDataTable;
use App\Models\Order;
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
        if ($user->hasRole('admin')) {
            return $dataTable->render('revenue.index');
        } elseif ($user->hasRole('pharmacy')) {
            $pharmacy = Pharmacy::where('user_id', $user->id)->first();
            $orders = Order::where('pharmacy_id', $pharmacy->id)->where('status','Delivered');
            $totalOrders = $orders->count();
            $totalRevenue = $orders->sum('price');
            return view('revenue.index', ['pharmacy' => $pharmacy,'orders'=>$totalOrders,'revenues'=>$totalRevenue]);
        }else{
            abort(403, 'Unauthorized action.');
        }
    }
}
