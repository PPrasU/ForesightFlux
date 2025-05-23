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
        Schema::create('data_source', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('display_name')->nullable();
            $table->date('periode_awal')->nullable();
            $table->date('periode_akhir')->nullable();
            $table->enum('sumber', ['Import', 'API']);
            $table->enum('jenis_data', ['Harian', 'Mingguan'])->default('Harian');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_source');
    }
};
