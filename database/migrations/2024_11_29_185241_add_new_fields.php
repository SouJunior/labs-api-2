<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('city', 60)->nullable(); 
            $table->string('state', 20)->nullable();
            $table->string('linkedin', 101)->nullable()->unique();
            $table->string('discord', 33)->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['city', 'state', 'linkedin', 'discord']);
        });
    }
};
