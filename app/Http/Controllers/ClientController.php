<?php

namespace App\Http\Controllers;

use App\DataTables\ClientsDataTable;
use App\Models\Area;
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
        $client = Client::where('id', '=', $national_id)->first();
        $user = User::where('id', $client->user_id)->first();
        $area = Area::where('id', $client->area_id)->first();
        return response()->json(['client' => $client, 'user' => $user, 'area' => $area]);
    }

    public function update(Request $request, $id)
    {
        dd($id);
        /*  if (is_numeric($id)) {
            try {
                Area::where('id', $id)->update($request->validated());
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('areas.index')->with('error', 'Cannot update a postal code for this areaa because of relation with other records ');
            }
            return to_route('areas.index')->with('success', 'Area updated successfully!')->with('timeout', 5000);
        } */
    }

    public function destroy($national_id)
    {
        if (is_numeric($national_id)) {
            try {
                $client = Client::where('id', '=', $national_id)->first();
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
