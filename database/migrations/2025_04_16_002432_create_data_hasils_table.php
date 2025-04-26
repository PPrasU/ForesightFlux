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
            $table->decimal('level', 15, 2);
            $table->decimal('trend', 15, 2);
            $table->decimal('seasonal', 15, 2);
            $table->decimal('forecast', 15, 2);
            $table->decimal('err_abs', 15, 4);
            $table->decimal('err_perc', 15, 2);
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
