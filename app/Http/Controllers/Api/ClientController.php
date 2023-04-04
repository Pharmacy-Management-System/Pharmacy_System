<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateClientRequest;
use App\Http\Resources\Api\ClientResource;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index($id)
    {
        return response()->json([
            "data" => new ClientResource(Client::find($id))
        ]);
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
                User::where('id', $client->user_id)->update($userData);
                $clientData = [];
                //  handle image
                if ($request->hasFile('avatar_image')) {
                    $avatar = $request->file('avatar_image');
                    $clientData['avatar_image'] = $avatar->getClientOriginalName();
                    $avatar->storeAs('public/clients_Images', $clientData['avatar_image']);
                } else {
                    $clientData['avatar_image'] = 'default.jpg';
                }
                // $clientData['id'] = $request->id; //national id 
                $clientData['date_of_birth'] = $request->date_of_birth;
                $clientData['gender'] = $request->gender;
                $clientData['phone'] = $request->phone;
                $client->update($clientData);
            } catch (\Illuminate\Database\QueryException $exception) {

                return "an error occurs, please try again later!!";
            }
            return response()->json([
                "message" => "Client updated successfully",
                "data" => new ClientResource(Client::find($national_id))
            ]);
        }
    }
}
