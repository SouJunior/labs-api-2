<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionUserController extends Controller
{
    public function __invoke(Request $request, string $uuid)
    {
        $user = User::query()->where('uuid', $uuid)->first();

        if (is_null($user)) {
            return response()->json([
                'error' => 'Usuário não encontrado.',
            ], 404);
        }

        if ($user->permission !== 'admin') {
            return response()->json(
                [
                    'error' => 'Você não tem permissão para atualizar este produto.',
                ],
                403
            );
        }

        $user->permission = $request->input('permission');
        $user->save();

        return response()->json(
            [
                'message' => 'Usuário atualizado com sucesso!',
                'User ' => $user
            ],
            200
        );

    }
}
