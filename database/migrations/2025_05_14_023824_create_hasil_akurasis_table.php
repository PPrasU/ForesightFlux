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
        Schema::create('hasil_akurasi', function (Blueprint $table) {
            $table->id();
            $table->decimal('mape', 15, 8)->nullable();
            $table->decimal('rmse', 15, 8)->nullable();
            $table->decimal('avg_actual', 15, 8)->nullable();
            $table->decimal('relative_rmse', 15, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_akurasi');
    }
};
