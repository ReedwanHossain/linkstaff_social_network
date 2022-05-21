<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Person;
use App\Models\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {   


        $person = new Person();
        // dd($user);
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->email = $request->email;
        $person->password = bcrypt($request->password);
        $person->save();
        return response()->json(['person' => $person]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ],401);
        }
        return $this->getToken($token);
    }

    public function getUser()
    {
        return response()->json([
            'person' => auth('api')->user(),
        ]);
    }

    public function getUserList()
    {   
        return  response()->json([
            'personlist' => Person::all(),
            'status' => 200,

        ], 200);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function refreshToken()
    {
        return $this->getToken(auth('api')->refresh());
    }

    protected function getToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'person' => auth('api')->user(),
        ]);
    }

}
