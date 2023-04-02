<?php

namespace App\Http\Controllers;

use App\DataTables\AddressesDataTable;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(AddressesDataTable $dataTable)
    {
        return $dataTable->render('addresses.index');
    }
}
