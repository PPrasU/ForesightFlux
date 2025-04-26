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
        Schema::create('data_import', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id');
            $table->string('date');
            $table->string('price');
            $table->string('open');
            $table->string('high');
            $table->string('low');
            $table->string('vol');
            $table->string('change');
            $table->timestamps();
        
            $table->foreign('source_id')->references('id')->on('data_source')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_import');
    }
};
