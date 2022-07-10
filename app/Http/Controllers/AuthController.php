<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validateData = $request->validate([
            'name'=>'nullable',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'role'=>'required',
        ]);

        $validateData['password'] = Hash::make($request->password);
        $user = User::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user'=> $user,
            'access_token'=> $accessToken,
            //'message'=>"L'usuari " . $user['name'] . " s'ha creat correctament"
        ],201);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return response([
                'message'=>"L'usuari i/o la contrasenya no son correctes"
            ],422); //401 No autoritzat
        }

        $accessToken = Auth::user()->createToken('authTestToken')->accessToken;

        return response([
            'user'=> Auth::user(),
            'access_token'=> $accessToken
        ]);
    }
}
