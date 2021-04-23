<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function register(Request $request)
    {

            return response()->json([
                'message' => 'Account was created successfully',
                'data' => $request->name
            ]);
    }
}
