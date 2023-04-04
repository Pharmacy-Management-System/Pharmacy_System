<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index($id)
    {
        dd(Client::find($id));
    }
    public function update(Request $request, $national_id)
     {
        dd($request);
        if (is_numeric($national_id)) {
            try {
                //  find client
                $client = Client::where('id', '=', $national_id)->first();
                // find user related to client and update
                $userData = [];
                $userData['name'] = $request->name;
                $userData['email'] = $request->email;
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
                
                return 'Error in Updating Client Record.';
            }
            return 'Client Record Updating Successfully.';
        }
    // dd("MAriam");
    }

}
