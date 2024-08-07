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
        Schema::create('pizza_rotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $$table->//save as datetime
            $table->foreignId('pizza_shift_id')->constrained('pizza_shifts', 'id')->cascadeOnDelete();
            $table->foreignId('pizza_staff_id')->constrained('pizza_staffs', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_rotas');
    }
};
