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
        Schema::create('pizza_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('company_id')->constrained('companies', 'id')->cascadeOnDelete();
            $table->dateTime('order_made_time')->nullable();
            $table->foreignId('staff_made_order')->constrained('pizza_staffs', 'id')->cascadeOnDelete();
            $table->foreignId('pizza_customer_id')->constrained('pizza_customers', 'id')->cascadeOnDelete();
            $table->foreignId('pizza_customer_address_id')->constrained('pizza_customer_addresses', 'id')->cascadeOnDelete();
            $table->enum('delivery', ['pending', 'delivering', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_orders');
    }
};
