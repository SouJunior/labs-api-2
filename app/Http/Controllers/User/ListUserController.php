<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListUserController extends Controller
{
    public function __invoke()
    {
        return User::select(
            'uuid',
            'name',
            'linkedin',
            'created_at',
            'updated_at'
        )->get();
    }
}
