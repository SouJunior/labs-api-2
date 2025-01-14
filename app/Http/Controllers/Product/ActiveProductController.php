<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveProductController extends Controller
{
    public function __invoke(Request $request, string $uuid)
    {
        $user = auth()->user();

        if ($user->permission !== 'admin') {

            return response()->json([
                'erro' => 'Você não tem permissão para atualizar esse produto'
            ], 403);
        }

        $product = Product::query()->where('uuid', $uuid)->first();

        if (!$product) {

            return response()->json([
                'erro' => 'Produto não encontrado'
            ], 404);
        }

        $product->active = $request->input('active');
        $product->save();

        if ($product->active == 1) {

            return response()->json([
                'message' => 'Produto ativado com sucesso'
            ], 200);

        }

        if ($product->active == 0) {

            return response()->json([
                'message' => 'Produto desativado com sucesso'
            ], 200);
        }
    }
}
