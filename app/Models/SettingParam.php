<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SettingParam extends Model
{
    use HasFactory;
    protected $table = 'setting_param';
    protected $fillable = ['alpha', 'beta', 'gamma', 'season_length_harian', 'season_length_mingguan', 'training_percentage', 'testing_percentage'];
}
