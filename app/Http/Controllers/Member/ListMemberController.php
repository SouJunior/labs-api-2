<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListMemberController extends Controller
{
    public function __invoke(string $squadUuid)
    {
        $member = Member::query()->where('squad_uuid', $squadUuid)->get();

        return response()->json($member);
    }
}
