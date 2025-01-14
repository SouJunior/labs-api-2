<?php

namespace App\Http\Controllers\Squad;

use App\Models\Squad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListSquadController extends Controller
{
    public function __invoke(string $productUuid = '')
    {
        if (!empty($productUuid)) {

            $squads = Squad::query()->where('product_uuid', $productUuid)->get();

        } else {

            $squads = Squad::all();
        }

        return response()->json($squads, 200);
    }
}
