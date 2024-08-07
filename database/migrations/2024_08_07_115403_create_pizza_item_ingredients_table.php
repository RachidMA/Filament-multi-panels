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
            $table->decimal('weight', 8, 2);
            // Storing weight as a decimal with 2 decimal places
            //             /**
            //              string('stock_order_point'):

            // Type: VARCHAR.
            // Usage: Intended for storing the reordering level or threshold for stock.
            // Status: ⚠️ Potential Issue - Like with weight, storing numbers as strings can be problematic. It's better to use an integer type if you are dealing with whole numbers or decimal for quantities that might require fractional values.
            //              **/
            $table->enum('unit', ['g', 'kg', 'lb', 'oz', 'l', 'ml']); // Predefined units for consistency
            $table->decimal('price', 10, 2);
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
