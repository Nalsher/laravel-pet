<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {

        try {
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            $token = $user->createToken('api-token')->plainTextToken;

            return response(["token" => $token], 201);

        } catch (Exception $ex) {
            return response(["error" => "somethin went wrong while creating user"], 400);
        }

    }
}
