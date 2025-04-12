<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Inserir permissões iniciais
        $permissions = [
            ['name' => 'cadastrar_produto'],
            ['name' => 'consultar_produto'],
            ['name' => 'editar_produto'],
            ['name' => 'deletar_produto']
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
