<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAPI extends Model
{
    use HasFactory;

    protected $table = 'data_api';

    protected $fillable = [
        'source_id',
        'date',
        'open',
        'high',
        'low',
        'close',
    ];

    public function source()
    {
        return $this->belongsTo(DataSource::class, 'source_id');
    }
}
