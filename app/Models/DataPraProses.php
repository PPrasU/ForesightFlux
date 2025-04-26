<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPraProses extends Model
{
    use HasFactory;

    protected $table = 'data_pra-proses';

    protected $fillable = ['source_id', 'date', 'price', 'category'];

    public function source()
    {
        return $this->belongsTo(DataSource::class, 'source_id');
    }
}
