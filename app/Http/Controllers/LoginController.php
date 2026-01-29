<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where("email", $email)->first();

        if (Hash::check($password, $user->password)) {
            $token = $user->createToken("api-key")->plainTextToken;
            return response(["token" => $token], 200);
        } else {
            return response(["error" => "Invalid-credentials"], 401);
        }
    }
}
