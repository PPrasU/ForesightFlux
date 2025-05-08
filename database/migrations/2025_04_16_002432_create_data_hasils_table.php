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
        Schema::create('data_hasil', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('price', 15, 2);
            $table->decimal('level', 15, 8)->nullable();
            $table->decimal('trend', 15, 8)->nullable();
            $table->decimal('seasonal', 15, 8)->nullable();
            $table->decimal('forecast', 15, 5);
            $table->decimal('error', 15, 8)->nullable();
            $table->decimal('abs_error', 15, 8)->nullable();
            $table->decimal('error_square', 15, 8)->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_hasil');
    }
};
