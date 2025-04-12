<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('permission')->insert([
            ['name' => 'Criar'],
            ['name' => 'Editar'],
            ['name' => 'Deletar'],
        ]);
    }
}
