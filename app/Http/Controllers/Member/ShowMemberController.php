<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowMemberController extends Controller
{
    public function __invoke(string $uuid, string $memberUuid)
    {
        $member = Member::query()->where('uuid', $memberUuid)->first();

        if (!$member) {

            return response()->json(['error' => 'Membro não encontrada', 404]);
        }

        return response()->json($member, 200);
    }
}
