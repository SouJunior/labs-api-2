<?php

namespace App\Http\Controllers\Member;

use Ramsey\Uuid\Uuid;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateMemberController extends Controller
{
    public function __invoke(Request $request, string $squadUuid)
    {
        $member = new Member();

        $member->uuid = Uuid::uuid4()->toString();
        $member->name = $request->input('name');
        $member->role = $request->input('role');
        $member->squad_uuid = $request->input('squad_uuid');
        $member->save();

        return response()->json([
            'message' => 'Membro criado com sucesso',
            'membro' => $member
        ], 201);
    }
}
