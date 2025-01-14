<?php

namespace App\Http\Controllers\Squad;

use App\Models\Squad;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteSquadController extends Controller
{
    public function __invoke(string $uuid)
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

            return response()->json(['error' => 'Você não tem autorização para atualizar essa squad'], 403);
        }

        $squad->delete();

        return response()->json(['message' => 'Squad apagada com sucesso'], 200);
    }
}
