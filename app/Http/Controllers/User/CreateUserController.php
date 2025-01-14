<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Env;
use Ramsey\Uuid\Uuid;

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

            'name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'email', 'unique:users'],
            'linkedin' => ['required', 'string', 'max:101'],
            'discord' => ['nullable', 'string', 'max:33'],
            'city' => ['nullable', 'string', 'max:60'],
            'state' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'min:8'],
            'register_token' => ['required', 'string'],
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Já existe uma conta com este e-mail.',
            'linkedin.required' => 'O campo Perfil no LinkedIn é obrigatório.',
            'discord.string' => 'O campo Perfil no Discord deve ser uma string.',
            'city.string' => 'O campo Cidade deve ser uma string.',
            'state.string' => 'O campo Estado deve ser uma string.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter pelo menos :min caracteres.',
            'register_token.required' => 'O campo register_token é obrigatório.',
        ]);

        $user = User::query()->create([

            'uuid' => Uuid::uuid4()->toString(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'linkedin' => $request->input('linkedin'),
            'discord' => $request->input('discord'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
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
