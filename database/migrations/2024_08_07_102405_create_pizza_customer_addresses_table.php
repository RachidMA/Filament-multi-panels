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
        Schema::create('pizza_customer_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('pizza_customer_id')->constrained('pizza_customers', 'id')->cascadeOnDelete();
            $table->string('address-1');
            $table->string('address-2')->nullable();
            $table->string('city');
            $table->string('zip_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_customer_addresses');
    }
};
