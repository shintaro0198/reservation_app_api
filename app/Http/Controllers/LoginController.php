<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        $item = User::where('email',$request->email)->first();
        if(Hash::check($item->hashed_password,$request->password)){
            return response()->json([
                'auth' => true
            ],200);
        }   else{
            return response()->json([
                'auth' => false
            ],404);
        }
    }
}
