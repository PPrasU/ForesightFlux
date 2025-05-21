<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilTesting extends Model
{
    use HasFactory;

    protected $table = 'hasil_testing';

    protected $fillable = [
        'source_id',
        'date',
        'actual',
        'forecast',
        'error',
        'abs_error',
        'error_square',
    ];

    public function source()
    {
        return $this->belongsTo(DataSource::class, 'source_id');
    }

}
