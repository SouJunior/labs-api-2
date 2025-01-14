<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowProductController extends Controller
{
    public function __invoke(string $uuid)
    {
        $product = Product::query()->where('uuid', $uuid)->first();

        if (!$product) {

            return response()->json([
                'error' => 'Produto não encontrado'
            ], 404);
        }

        return response()->json($product, 200);
    }
}
