<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilAkurasi extends Model
{
    use HasFactory;

    protected $table = 'hasil_akurasi';

    protected $fillable = [
        'mape',
        'rmse',
        'avg_actual',
        'relative_rmse',
    ];

}
