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
            $table->unsignedBigInteger('source_id');
            $table->date('date_forecast');
            $table->decimal('forecast', 15, 2)->nullable();
            $table->decimal('level', 15, 8)->nullable();
            $table->decimal('trend', 15, 8)->nullable();
            $table->decimal('seasonal', 15, 8)->nullable();
            $table->timestamps();

            $table->foreign('source_id')->references('id')->on('data_source');
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
