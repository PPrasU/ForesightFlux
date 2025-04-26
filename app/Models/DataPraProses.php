<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPraProses extends Model
{
    use HasFactory;

    protected $table = 'data_pra_proses';

    protected $fillable = ['data_historis_id', 'date', 'price'];

    public function dataApi()
    {
        return $this->belongsTo(DataApi::class, 'data_historis_id');
    }

    public function hasil()
    {
        return $this->hasOne(DataHasil::class, 'data_pra_proses_id');
    }
}
