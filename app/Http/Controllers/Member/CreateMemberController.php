<?php

namespace App\Http\Controllers\Member;

use App\Models\Squad;
use Ramsey\Uuid\Uuid;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateMemberController extends Controller
{
    public function __invoke(Request $request, string $squadUuid)
    {
        $member = new Member();

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

        $member->uuid = Uuid::uuid4()->toString();
        $member->name = $request->input('name');
        $member->role = $request->input('role');
        $member->squad_uuid = $squadUuid;
        $member->save();

        return response()->json([
            'message' => 'Membro criado com sucesso',
            'membro' => $member
        ], 201);
    }
}
