<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function store(StoreClientRequest $request)
    {
        //dd($request);
        try {
            // create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
            ]);
            //  handle image 
            if ($request->hasFile('avatar_image')) {
                $avatar = $request->file('avatar_image');
                $avatar_name = $avatar->getClientOriginalName();
                $avatar->storeAs('public/clients_Images', $avatar_name);
            } else {
                $avatar_name = 'default.jpg';
            }

            // create client 
            Client::create([
                'id' => $request->id,
                'user_id' => $user->id,
                'avatar_image' => $avatar_name,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'phone' => $request->phone,
            ]);
        } catch (\Illuminate\Database\QueryException $exception) {
            //return to_route('clients.index')->with('error', 'Error in Creating Client.')->with('timeout', 3000);
            return "Error in creating client";
        }
       // return to_route('clients.index')->with('success', 'Client has been created successfully!')->with('timeout', 3000);
       return "Client has been created successfully!";
    }

}
