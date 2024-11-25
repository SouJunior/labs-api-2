<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditMemberController extends Controller
{
    public function __invoke(request $request, string $uuid, string $memberUuid)
    {
        $member = Member::query()->where(['squad_uuid' => $uuid, 'uuid' => $memberUuid])->first();

        if (!$member) {

            return response()->json(['error' => 'Membro não encontrado'], 404);
        }

        $request->validate([

            'name' => ['required', 'string', 'max:60'],
            'role' => ['required', 'string', 'max:30']

        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'role.required' => 'O campo cargo é obrigatório',
            'role.string' => 'O campo cargo deve ser uma string.',
            'role.max' => 'O campo cargo não pode ter mais de :max caracteres.'
        ]);

        $member->name = $request->input('name');
        $member->role = $request->input('role');
        $member->save();

        return response()->json(['message' => 'Membro atualizado com sucesso'], 200);
    }
}
