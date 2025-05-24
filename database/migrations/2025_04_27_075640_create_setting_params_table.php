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
        Schema::create('setting_param', function (Blueprint $table) {
            $table->id();
            $table->decimal('alpha', 15, 4);
            $table->decimal('beta', 15, 4);
            $table->decimal('gamma', 15, 4);
            $table->decimal('season_length_harian', 15, 4)->nullable();
            $table->decimal('season_length_mingguan', 15, 4)->nullable();
            $table->decimal('training_percentage', 15, 4);
            $table->decimal('testing_percentage', 15, 4);
            $table->timestamps();
        });
        DB::table('setting_param')->insert([
            'alpha' => 0.6,
            'beta' => 0.5,
            'gamma' => 0.1,
            'season_length_harian' => 30,
            'season_length_mingguan' => 4,
            'training_percentage' => 80,
            'testing_percentage' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_param');
    }
};
