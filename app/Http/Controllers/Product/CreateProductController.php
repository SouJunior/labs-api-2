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

        $request->validate([

            'name' => ['required', 'string', 'max:60'],
            'description' => ['required', 'string']

        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'description.required' => 'Ocampo descrição é obrigatório',
            'description.string' => 'O campo descrição deve ser uma string.'
        ]);

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
