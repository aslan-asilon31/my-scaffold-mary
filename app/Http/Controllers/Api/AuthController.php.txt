<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Auth;  

class AuthController extends Controller  
{  
    public function login(Request $request)  
    {  
        $request->validate([  
            'username' => 'required|string',  
            'password' => 'required|string',  
        ]);  
  
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {  
            $user = Auth::user();  
            $token = $user->createApiToken();  
            return response()->json([  
                'token' => $token,  
                'user' => $user,  
            ], 200);  
        }  
        return response()->json(['message' => 'Username atau password salah.'], 401);  
    } 
  
    public function logout(Request $request)  
    {  
        Auth::logout();  
        return response()->json(['message' => 'Logged out successfully']);  
    }  
}  
