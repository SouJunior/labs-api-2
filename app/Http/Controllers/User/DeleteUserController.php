<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteUserController extends Controller
{
    public function __invoke(Request $request, string $uuid)
    {
        $user = auth()->user();

        if ($user->uuid !== $uuid) {

            return response()->json([
                'error' => 'Você não tem permissão para deletar este usuário.',
            ], 403);
        }

        if (!$uuid) {

            return response()->json([
                'error' => 'O email é necessário para deletar o usuário.',
            ], 400);
        }

        $user = User::query()->where('uuid', $uuid)->first();

        if (!$user) {

            return response()->json([
                'error' => 'Usuário não encontrado.',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'Usuário deletado com sucesso!',
        ], 200);
    }
}
