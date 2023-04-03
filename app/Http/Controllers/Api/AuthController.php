<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(StoreClientRequest $request)
    {
        try {
            // create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
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
        // event(new Registered($user));
        // event(new Registered($user));
        // auth()->login($user);
        //$user->sendEmailVerificationNotification();
        $user->assignRole('client');
        return "Client has been created successfully!";
    }
    public function getToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->whereHas('roles', function ($role) {
                return $role->where('name', 'admin');
            })
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
