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
        Schema::create('petunjuk_api', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('desk_1');
            $table->string('desk_2');
            $table->string('desk_3')->nullable();
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petunjuk_api');
    }
};