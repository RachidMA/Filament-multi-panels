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
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('pizza_item_ingredient_id')->constrained('pizza_item_ingredients', 'id')->cascadeOnDelete();
            $table->foreignId('company_id')->constrained('companies', 'id')->cascadeOnDelete();
            $table->decimal('quantity', 10, 2);
            $table->string('type'); // e.g., 'received', 'used', 'wasted'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
