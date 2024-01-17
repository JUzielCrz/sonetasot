<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return response()->json([
                'message' => 'Usuario Logueado correctamente',
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);
        }

        return response()->json([
            'errors' => ['Unauthorized'],
        ], 401);
    }

}
