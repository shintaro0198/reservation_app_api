<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(){
        return response()->json([
            'auth' => true
        ],200);
    }
}
