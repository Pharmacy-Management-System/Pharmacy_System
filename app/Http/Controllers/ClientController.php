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
use Illuminate\Support\Facades\Hash;

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
        $addresses = Address::where('client_id', $client->id)->get();
        foreach ($addresses as $address) {
            $address->area_name = $address->area->name;
        }
        return response()->json(['client' => $client, 'user' => $user, 'addresses' => $addresses]);
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
                    $clientData['avatar_image'] = 'default-avatar.jpg';
                }
                $clientData['id'] = $request->id;
                $clientData['date_of_birth'] = $request->date_of_birth;
                $clientData['gender'] = $request->gender;
                $clientData['phone'] = $request->phone;
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

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->hasFile('avatar_image')) {
                $avatar = $request->file('avatar_image');
                $avatar_name = $avatar->getClientOriginalName();
                $avatar->storeAs('public/clients_Images', $avatar_name);
            } else {
                $avatar_name = 'default-avatar.jpg';
            }

            $isChecked = 0;
            if ($request->has('is_main')) {
                $isChecked = 1;
            }

            Client::create([
                'id' => $request->id,
                'user_id' => $user->id,
                'avatar_image' => $avatar_name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'phone' => $request->phone,
            ]);

            $user->assignRole('client');
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
                return to_route('clients.index')->with('error', 'Error in Deleting Client Record Please Delete Related Records First.')->with('timeout', 3000);
            }
            return to_route('clients.index')->with('success', 'Client Record Deleted Successfully.')->with('timeout', 3000);
        }
    }
}