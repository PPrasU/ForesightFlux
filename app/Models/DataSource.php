<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSource extends Model
{
    use HasFactory;

    protected $table = 'data_source';

    protected $fillable = ['name', 'display_name', 'periode_awal', 'periode_akhir', 'jangka_waktu', 'sumber'];

    public function dataImports()
    {
        return $this->hasMany(DataImport::class, 'source_id');
    }

    public function dataApis()
    {
        return $this->hasMany(DataApi::class, 'source_id');
    }
}
