<?php

namespace App\Http\Controllers\Product;

use Ramsey\Uuid\Uuid;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateProductController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        $product = new Product();

        $product->uuid = Uuid::uuid4()->toString();
        $product->owner_uuid = $user->uuid;
        $product->name = $request->input('name');
        $product->description = $request->input('description');

        $product->save();

        return response()->json([
            'message' => 'Produto cadastrado com sucesso',
            'product' => $product
        ], 201);
    }
}
