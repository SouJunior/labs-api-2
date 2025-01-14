<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Http\Controllers\Controller;

class ListProductController extends Controller
{
    public function __invoke(string $userUuid = '')
    {
        if (!empty($userUuid)) {

            $products = Product::query()->where('owner_uuid', $userUuid)->get();

        } else {

            $products = Product::all();
        }

        return response()->json($products, 200);
    }
}
