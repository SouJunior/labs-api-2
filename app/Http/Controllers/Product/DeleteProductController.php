<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteProductController extends Controller
{
    public function __invoke(string $uuid)
    {
        $product = Product::query()->where('uuid', $uuid)->first();

        $user = auth()->user();

        if (!$product) {

            return response()->json([
                'error' => 'Produto não encontrado'
            ], 404);
        }

        if ($user->uuid !== $product->owner_uuid) {

            return response()->json([
                'error' => 'Você não tem permissão para atualizar esse produto'
            ], 403);
        }

        $product->delete();

        return response()->json([
            'Message' => 'Produto deletado com sucesso'
        ], 200);
    }
}
