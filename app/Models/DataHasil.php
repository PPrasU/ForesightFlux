<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataHasil extends Model
{
    use HasFactory;

    protected $table = 'data_hasil';

    protected $fillable = [
        'data_pra_proses_id',
        'date',
        'price',
        'level',
        'trend',
        'seasonal',
        'err_abs',
        'err_perc'
    ];

    public function praProses()
    {
        return $this->belongsTo(DataPraProses::class, 'data_pra_proses_id');
    }
}
