<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteMemberController extends Controller
{
    public function __invoke(string $uuid, string $memberUuid)
    {
        $member = Member::query()->where(['uuid' => $memberUuid])->first();

        if (!$member) {

            return response()->json(['error' => 'Membro não encontrado'], 404);
        }

        $member->delete();

        return response()->json(['message' => 'Membro apagado com sucesso'], 200);
    }
}
