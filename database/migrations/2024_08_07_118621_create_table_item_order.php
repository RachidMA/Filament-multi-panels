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
        //THIS IS PIVOT TABLE BETWEEN ITEMS AND ORDERS TABLES
        Schema::create('table_item_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('pizza_menu_item_id')->constrained('pizza_menu_items', 'id')->cascadeOnDelete();
            $table->foreignId('pizza_order_id')->constrained('pizza_orders', 'id')->cascadeOnDelete();
            $table->string('quantity'); //one item or two items, 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_item_order');
    }
};
