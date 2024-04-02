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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('color_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->string('sku')->unique();
            $table->string('image')->nullable();
            $table->decimal('stock_price', 10.0)->default(0);
            $table->decimal('price', 10.0)->default(0);
            $table->integer('s_price')->default(0);
            $table->enum('sp_type', ['Fixed', 'Percent']);
            $table->bigInteger('total_qnt')->default(0);
            $table->bigInteger('qnt')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
