<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissioms = [
            ['name' => 'cadastrar_produto'],
            ['name' => 'consultar_produto'],
        ];
        DB::table('permission')->insert($permissioms);
    }
}
