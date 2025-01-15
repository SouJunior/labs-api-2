<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditUserController extends Controller
{
    public function __invoke(Request $request, string $uuid)
    {
        $user = User::query()->where('uuid', $uuid)->first();

        if (!$user) {

            return response()->json([
                'error' => 'Usuário não encontrado.',
            ], 404);
        }

        $request->validate([

            'name' => ['required', 'string', 'max:60'],
            'email' => ['nullable', 'email'],
            'password' => ['min:8'],
            'permission' => ['nullable', 'in:admin,founder'],
            'linkedin' => ['nullable', 'string', 'max:101'],
            'discord' => ['nullable', 'string', 'max:33'],
            'city' => ['nullable', 'string', 'max:60'],
            'state' => ['nullable', 'string', 'max:20']
        ], [
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'password.min' => 'O campo senha deve ter pelo menos :min caracteres.',
            'permission.in' => 'O campo Permissão deve ser admin ou founder',
            'linkedin.string' => 'O campo LinkedIn deve ser uma string.',
            'linkedin.max' => 'O campo LinkedIn não pode ter mais de :max caracteres.',
            'discord.string' => 'O campo Discord deve ser uma string.',
            'discord.max' => 'O campo Discord não pode ter mais de :max caracteres.',
            'city.string' => 'O campo cidade deve ser uma string.',
            'city.max' => 'O campo cidade não pode ter mais de :max caracteres.',
            'state.string' => 'O campo estado deve ser uma string.',
            'state.max' => 'O campo estado não pode ter mais de :max caracteres.',
        ]);

        $email = $request->input('email');
        $name = $request->input('name');
        $linkedin = $request->input('linkedin');
        $discord = $request->input('discord');
        $city = $request->input('city');
        $state = $request->input('state');
        $permission = $request->input('permission') ?? $user->permission;
        $password = $request->input('password');


        if ($name) {
            $user->name = $name;
        }

        if ($email) {
            $user->email = $email;
        }

        if ($linkedin) {
            $user->linkedin = $linkedin;
        }

        if ($discord) {
            $user->discord = $discord;
        }

        if ($city) {
            $user->city = $city;
        }

        if ($state) {
            $user->state = $state;
        }

        if ($password) {
            $user->password = bcrypt($password);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso.',
        ], 200);
    }
}
