<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $request->validate([

            'email' => ['required', 'email'],
            'password' => ['required']

        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password' => 'required|string|min:8'
        ]);


        if (!auth()->attempt($request->only('email', 'password'))) {

            return response()->json([
                'message' => 'Credenciais inválidas.',
            ], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 200);

    }
}
