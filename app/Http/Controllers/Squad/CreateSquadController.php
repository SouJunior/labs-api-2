<?php

namespace App\Http\Controllers\Squad;

use App\Models\Squad;
use Ramsey\Uuid\Uuid;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateSquadController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $product = Product::query()->where('owner_uuid', $user->uuid)->first();
        $squad = new Squad();

        $squad->uuid = Uuid::uuid4()->toString();
        $squad->product_uuid = $product->uuid;
        $squad->name = $request->input('name');
        $squad->description = $request->input('description');
        $squad->save();

        return response()->json([
            'message' => 'Squad cadastrado com sucesso',
            'Squad' => $squad
        ], 201);
    }
}
