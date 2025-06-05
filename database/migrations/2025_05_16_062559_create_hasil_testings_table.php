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
        Schema::create('hasil_testing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id');
            $table->date('date');
            $table->decimal('actual', 20, 2);
            $table->decimal('forecast', 20, 5);
            $table->decimal('level', 20, 8)->nullable();
            $table->decimal('trend', 20, 8)->nullable();
            $table->decimal('seasonal', 20, 8)->nullable();
            $table->decimal('error', 20, 8)->nullable();
            $table->decimal('abs_error', 20, 8)->nullable();
            $table->decimal('error_square', 20, 8)->nullable();
            $table->timestamps();

            $table->foreign('source_id')->references('id')->on('data_source');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_testing');
    }
};
