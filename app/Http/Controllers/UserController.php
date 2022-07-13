<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $user = User::find($id);

        $validator = Validator::make($input, ['name' => 'unique:users|required']);

        if($validator->fails()){
            return response()->json(["success" => false, "message" => "El nom triat no compleix requisits de validació"],400);
        }

        $user->name = $input['name'];
        $user->save();

        return response()->json(["success" => true, "message" => "Nom actualitzat correctament", "data" => $user],200);
        
    }
}
