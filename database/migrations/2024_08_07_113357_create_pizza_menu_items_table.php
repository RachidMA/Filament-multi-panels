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
        Schema::create('pizza_menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->unique();
            $table->foreignId('company_id')->constrained('companies', 'id')->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('category'); //pizza,side(fries, cookies, more...), drink
            $table->string('size')->nullable(); //large,medium,small
            $table->decimal('price', 10, 2); //THIS IS THE ACCTUAL SELLING PRICE 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_menu_items');
    }
};
