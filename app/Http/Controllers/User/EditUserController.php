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
            'phone' => ['nullable', 'string', 'max:15'],  // Adicionado recentemente
            'address' => ['nullable', 'string', 'max:255'], // Adicionado recentemente

        ], [
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'password.min' => 'O campo senha deve ter pelo menos :min caracteres.',
            'phone.string' => 'O campo telefone deve ser uma string.', // Adicionado recentemente
            'phone.max' => 'O campo telefone não pode ter mais de :max caracteres.', // Adicionado recentemente
            'address.string' => 'O campo endereço deve ser uma string.', // Adicionado recentemente
            'address.max' => 'O campo endereço não pode ter mais de :max caracteres.', // Adicionado recentemente
        ]);

        $email = $request->input('email');
        $name = $request->input('name');
        $linkedin = $request->input('linkedin');
        $password = $request->input('password');

        $user->name = $name;

        if ($email) {
            $user->email = $email;
        }

        $user->linkedin = $linkedin;

        if ($password) {
            $user->password = bcrypt($password);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso.',
        ], 200);
    }
}
