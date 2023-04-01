<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('order.index',['pharmacies'=>Pharmacy::all(),'doctors'=>Doctor::all(),'medicines'=>Medicine::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        if (is_numeric($id)) {
            try {
                Order::where('id', $id)->delete();
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('orders.index')->with('error', ' you can not delete this order');
            }
            return to_route('orders.index');
        }
    }
}
