<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataImport extends Model
{
    use HasFactory;

    protected $table = 'data_import';

    protected $fillable = ['source_id', 'date', 'price', 'open', 'high', 'low', 'vol', 'change'];

    public function source()
    {
        return $this->belongsTo(DataSource::class, 'source_id');
    }
}
