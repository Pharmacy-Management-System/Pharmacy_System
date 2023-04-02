<?php

namespace App\Http\Controllers;

use App\DataTables\ClientsDataTable;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Address;
use App\Models\Area;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(ClientsDataTable $dataTable)
    {
        return $dataTable->render('clients.index', ['areas' => Area::all()]);
    }

    public function show($national_id)
    {
        $client = Client::where('id', '=', $national_id)->first();
        $user = User::where('id', $client->user_id)->first();
        $addresses=Address::where('client_id',$client->id)->get();
        foreach($addresses as $address)
        {
            $address->area_name=$address->area->name;
        }
        return response()->json(['client' => $client, 'user' => $user,'addresses'=>$addresses]);
    }

    public function update(UpdateClientRequest $request, $national_id)
    {
        if (is_numeric($national_id)) {
            try {
                //  find client
                $client = Client::where('id', '=', $national_id)->first();
                // find user related to client and update
                $userData = [];
                $userData['name'] = $request->name;
                $userData['email'] = $request->email;
                User::where('id', $client->user_id)->update($userData);
                // update client data
                $clientData = [];
                //  handle image 
                if ($request->hasFile('avatar_image')) {
                    $avatar = $request->file('avatar_image');
                    $clientData['avatar_image'] = $avatar->getClientOriginalName();
                    $avatar->storeAs('public/clients_Images', $clientData['avatar_image']);
                } else {
                    $clientData['avatar_image'] = 'default.jpg';
                }
                // handle checkbox
                $clientData['is_main'] = 0;
                if ($request->has('is_main')) {
                    $clientData['is_main'] = 1;
                }
                $clientData['id'] = $request->id;
                $clientData['date_of_birth'] = $request->date_of_birth;
                $clientData['gender'] = $request->gender;
                $clientData['area_id'] = $request->area_id;
                $clientData['phone'] = $request->phone;
                $clientData['street_name'] = $request->street_name;
                $clientData['building_no'] = $request->building_no;
                $clientData['floor_number'] = $request->floor_number;
                $clientData['flat_number'] = $request->flat_number;
                $client->update($clientData);
            } catch (\Illuminate\Database\QueryException $exception) {
                return to_route('clients.index')->with('error', 'Error in Updating Client Record.')->with('timeout', 3000);
            }
            return to_route('clients.index')->with('success', 'Client Record Updating Successfully.')->with('timeout', 3000);
        }
    }

    public function store(StoreClientRequest $request)
    {
        try {
            // create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            //  handle image 
            if ($request->hasFile('avatar_image')) {
                $avatar = $request->file('avatar_image');
                $avatar_name = $avatar->getClientOriginalName();
                $avatar->storeAs('public/clients_Images', $avatar_name);
            } else {
                $avatar_name = 'default.jpg';
            }
            // handle checkbox
            $isChecked = 0;
            if ($request->has('is_main')) {
                $isChecked = 1;
            }
            // craete client 
            Client::create([
                'id' => $request->id,
                'user_id' => $user->id,
                'avatar_image' => $avatar_name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'phone' => $request->phone,
                'area_id' => $request->area_id,
                'street_name' => $request->street_name,
                'building_no' => $request->building_no,
                'floor_number'  => $request->floor_number,
                'flat_number' => $request->flat_number,
                'is_main' => $isChecked
            ]);
        } catch (\Illuminate\Database\QueryException $exception) {
            return to_route('clients.index')->with('error', 'Error in Creating Client.')->with('timeout', 3000);
        }
        return to_route('clients.index')->with('success', 'Client has been created successfully!')->with('timeout', 3000);
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
                return to_route('clients.index')->with('error', 'Error in Deleting Client Record.')->with('timeout', 3000);
            }
            return to_route('clients.index')->with('success', 'Client Record Deleted Successfully.')->with('timeout', 3000);
        }
    }
}
