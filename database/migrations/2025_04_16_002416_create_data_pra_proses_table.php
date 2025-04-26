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
        Schema::create('data_pra-proses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('price', 15, 2);
            $table->enum('kategori', ['Training', 'Testing']);
            $table->timestamps();
        
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pra-proses');
    }
};
