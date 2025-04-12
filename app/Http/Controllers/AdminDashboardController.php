<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Bem-vindo ao painel administrativo!']);
    }
}
