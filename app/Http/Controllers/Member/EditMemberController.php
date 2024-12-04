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

        $member->name = $request->input('name');
        $member->role = $request->input('role');
        $member->save();

        return response()->json(['message' => 'Membro atualizado com sucesso'], 200);
    }
}
