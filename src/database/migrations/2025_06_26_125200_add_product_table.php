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
            $table->id();
            $table->string('name');
            $table->string('url')->nullable();
            $table->double('price');
            $table->double('opt_price');
            $table->string('picture')->nullable();
            $table->string('articul')->unique();
            $table->string('vendor');
            $table->string('description')->nullable();
            $table->boolean('available');
            $table->boolean('status_new');
            $table->boolean('status_action');
            $table->boolean('status_top');
            $table->foreignId('extprop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
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
