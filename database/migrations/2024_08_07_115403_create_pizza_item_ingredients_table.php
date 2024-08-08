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
        Schema::create('pizza_item_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->foreignId('company_id')->constrained('companies', 'id')->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained('suppliers', 'id')->cascadeOnDelete();
            $table->decimal('weight', 8, 2);
            $table->enum('unit', ['g', 'kg', 'lb', 'oz', 'l', 'ml']); // Predefined units for consistency
            $table->decimal('price', 10, 2); //THIS IS WHOLE SALE PRICE
            $table->integer('stock_order_point'); // Using integer for stock level
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_item_ingredients');
    }
};
