<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAddressRequest;
use App\Http\Resources\Api\AddressResource;
use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $auth_user = auth()->user();
        $client = Client::where("user_id", '=', $auth_user->id)->first();
        $addresses = Address::where("client_id", $client->id)->get();
        if ($addresses->count() > 0)
            return AddressResource::collection($addresses);
        else
            return response()->json(["message" => "This User does not have any addresses"], 404);
    }

    public function show($address_id)
    {
        $auth_user = auth()->user();
        $client = Client::where("user_id", '=', $auth_user->id)->first();
        $address = Address::where("client_id", $client->id)->find($address_id);
        if ($address)
            return new AddressResource($address);
        else
            return response()->json(["message" => "This User does not have any addresses with this id"], 404);
    }
    public function store(StoreAddressRequest $request)
    {
        try {
            $auth_user = auth()->user();
            $client = Client::where("user_id", '=', $auth_user->id)->first();
            $addressData = [];
            $addressData['client_id'] = $client->id;
            $addressData['is_main'] = $request->is_main;
            $addressData['area_id'] = $request->area_id;
            $addressData['street_name'] = $request->street_name;
            $addressData['building_number'] = $request->building_number;
            $addressData['floor_number'] = $request->floor_number;
            $addressData['flat_number'] = $request->flat_number;
            $address = Address::create($addressData);
        } catch (\Illuminate\Database\QueryException $exception) {
            return "an error occurs, please try again later!!";
        }
        return response()->json([
            "message" => "Address added successfully",
            "data" => new AddressResource($address)
        ]);
    }
    public function update(StoreAddressRequest $request, $address_id)
    {
        if (is_numeric($address_id)) {
            try {
                $auth_user = auth()->user();
                $client = Client::where("user_id", '=', $auth_user->id)->first();
                $address = Address::where("client_id", $client->id)->find($address_id);
                $addressData = [];
                // handle checkbox
                $addressData['is_main'] = $request->is_main;
                $addressData['area_id'] = $request->area_id;
                $addressData['street_name'] = $request->street_name;
                $addressData['building_number'] = $request->building_number;
                $addressData['floor_number'] = $request->floor_number;
                $addressData['flat_number'] = $request->flat_number;
                $address->update($addressData);
            } catch (\Illuminate\Database\QueryException $exception) {
                return "an error occurs, please try again later!!";
            }
            return response()->json([
                "message" => "Address updated successfully",
                "data" => new AddressResource($address)
            ]);
        }
    }
    public function destroy($address_id)
    {
        $auth_user = auth()->user();
        $client = Client::where("user_id", '=', $auth_user->id)->first();
        $address = Address::where("client_id", $client->id)->find($address_id);
        if ($address) {
            $address->delete();
            return response()->json(["message" => "Address deleted successfully"], 200);
        } else
            return response()->json(["message" => "This User does not have any addresses with this id to delete"], 404);
    }
}
