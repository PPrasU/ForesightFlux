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
        Schema::create('data_api', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id');
            $table->string('date');
            $table->decimal('open', 15, 2);
            $table->decimal('high', 15, 2);
            $table->decimal('low', 15, 2);
            $table->decimal('close', 15, 2);
            $table->timestamps();
        
            $table->foreign('source_id')->references('id')->on('data_source');
        });    
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_api');
    }
};
