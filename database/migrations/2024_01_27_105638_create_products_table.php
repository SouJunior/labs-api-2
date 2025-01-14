<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->uuid('owner_uuid')->nullable();
            $table->string('name');
            $table->text('description');
            $table->integer('active')->nullable()->default(1);
            $table->datetimes();

            $table->index('uuid');
            $table->index('owner_uuid');

            $table->foreign('owner_uuid')
                ->references('uuid')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
