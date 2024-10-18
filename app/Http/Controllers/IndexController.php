<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Env;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->input('user', 'Laravel');
        $method = $request->getMethod();

        return response()->json([
            'method' => $method,
            'message' => "Hello bro, {$user}.",
            'env' => env('DB_DATABASE'),
        ], 200);
    }
}
