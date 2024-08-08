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
        Schema::create('pizza_item_ingredient_recipes', function (Blueprint $table) {
            //THIS TABLE WILL CONNECT BETWEEN THE ITEM AND THE INGREDIENTS NEEDED TO CREATED IT
            $table->bigIncrements('id');
            $table->string('pizza_menu_item_sku'); // Foreign key to pizza_menu_items
            $table->foreignId('company_id')->constrained('companies', 'id')->cascadeOnDelete();
            $table->unsignedBigInteger('pizza_item_ingredient_id');      // Foreign key to ingredients
            $table->decimal('quantity', 8, 2);                // Quantity of the ingredient needed
            $table->enum('measurement_unit', ['g', 'kg', 'oz', 'lb', 'ml', 'l']); // Measurement units
            // Foreign key constraints
            $table->foreign('pizza_menu_item_sku')->references('sku')->on('pizza_menu_items')->onDelete('cascade');
            $table->foreign('pizza_item_ingredient_id')->references('id')->on('pizza_item_ingredients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_item_ingredient_recipes');
    }
};
