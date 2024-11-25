<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditProductController extends Controller
{
    public function __invoke(Request $request, string $uuid)
    {
        $user = auth()->user();

        $product = Product::query()->where('uuid', $uuid)->first();

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

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();

        return response()->json([
            'message' => 'Produto atualizado com sucesso',
            'Product' => $product
        ], 200);
    }
}
