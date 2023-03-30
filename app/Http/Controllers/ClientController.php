<?php

namespace App\Http\Controllers;

use App\DataTables\ClientsDataTable;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(ClientsDataTable $dataTable)
    {
        //dd($dataTable);
        return $dataTable->render('clients.index');
    }

    public function show($national_id)
    {
        $client = Client::where('national_id', '=', $national_id)->first();
        $user = User::where('id', $client->user_id)->first();
        return response()->json(['client' => $client, 'user' => $user]);
        // return view('clients.show', ['id' => $id]);
    }

    public function destroy($national_id)
    {
        if (is_numeric($national_id)) {
            try {
                $client = Client::where('national_id', '=', $national_id)->first();
                $user = User::where('id', $client->user_id)->first();
                Client::destroy($national_id);
                User::destroy($user->id);
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('clients.index')->with('error', 'Error in Deleting the Record.');
            }
            return to_route('clients.index')->with('success', 'Record Deleted Successfully.');
        }
    }
}
