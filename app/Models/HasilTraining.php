<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilTraining extends Model
{
    use HasFactory;

    protected $table = 'hasil_training';

    protected $fillable = [
        'source_id',
        'date',
        'price',
        'level',
        'trend',
        'seasonal',
        'forecast',
        'error',
        'abs_error',
        'error_square'
    ];

    public function source()
    {
        return $this->belongsTo(DataSource::class, 'source_id');
    }
}
