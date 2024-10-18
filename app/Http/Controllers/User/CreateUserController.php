<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Env;
use App\Http\Controllers\Controller;

class CreateUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $token = $request->input('register_token');

        if ($token !== env('REGISTER_TOKEN')) {

            return response()->json([
                'error' => 'Token inválido.',
            ], 403);
        }

        $request->validate([

            'name' => ['required|string|max:60'],
            'email' => ['required|email|unique:users'],
            'linkedin' => ['required'],
            'password' => ['required|min:8'],
            'register_token' => ['required|string']

        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            /* 'email.required' => 'O campo e-mail é obrigatório.', */
            /* 'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.', */
            /* 'email.unique' => 'Já existe uma conta com este e-mail.', */
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter pelo menos :min caracteres.',
            'register_token.required' => 'O campo register_token é obrigatório.',
            'linkedin.required' => 'O campo Linkedin é obrigatório.'
        ]);

        $user = User::query()->create([

            'uuid' => Uuid::uuid4()->toString(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'linkedin' => $request->input('linkedin'),
            'permission' => 'founder',
            'password' => bcrypt($request->input('password')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if ($user) {

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso.',
            ], 201);

        } else {

            return response()->json([
                'error' => 'Não foi possível realizar o cadastro.',
            ], 500);
        }
    }
}
