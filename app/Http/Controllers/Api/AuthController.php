<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[ // Validate the request
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|string|max:25|confirmed',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $studentRole = Role::where ('name','student')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id'=> $studentRole->id,
        ]);
        $token = $user->createToken('auth-token');
        return ['token'=>$token->plainTextToken];
    }
}
