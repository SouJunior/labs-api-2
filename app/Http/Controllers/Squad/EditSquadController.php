<?php

namespace App\Http\Controllers\Squad;

use App\Models\Squad;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditSquadController extends Controller
{
    public function __invoke(Request $request, string $uuid)
    {
        $user = auth()->user();
        $squad = Squad::query()->where('uuid', $uuid)->first();

        if (!$squad) {

            return response()->json(['error' => 'Squad não encontrada'], 404);
        }

        $product = Product::query()->where('uuid', $squad->product_uuid)->first();

        if (!$product) {

            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        if ($user->uuid !== $product->owner_uuid) {

            return response()->json(['error' => 'Você não tem permissão para atualizar esse produto'], 403);
        }


        $request->validate([

            'name' => ['required', 'string', 'max:60'],
            'role' => ['required', 'string', 'max:30']

        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'role.required' => 'O campo cargo é obrigatório',
            'role.string' => 'O campo cargo deve ser uma string.',
            'role.max' => 'O campo cargo não pode ter mais de :max caracteres.'
        ]);

        $squad->name = $request->input('name');
        $squad->description = $request->input('description');
        $squad->save();


        return response()->json([
            'message' => 'Squad atualizado com sucesso',
            'squad' => $squad
        ], 200);
    }
}
