<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\Api\ClientResource;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
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
            return "Error in creating client";
        }
        $user->assignRole('client');
        event(new Registered($user));
        return response()->json([
            "message" => "Client added successfully",
            "data" => new ClientResource(Client::find($request->id))
        ]);
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
                $role->where('name', 'client');
            })
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        //dd($user);
        User::where('id', $user->id)->update([
            "last_login" =>  Carbon::now()
        ]);

        $token = $user->createToken($request->device_name)->plainTextToken;
        //$user->last_login = Carbon::now();
        $token=$user->createToken($request->device_name)->plainTextToken;

        return $token;
    }
    public function resend($id)
    {
        $client = Client::find($id);
        if ($client->user->email_verified_at) {
            return response()->json('User already have verified email!', 422);
        } 
        $client->user->sendEmailVerificationNotification();
        return response()->json('The email verification has been resubmitted');
    }
}
