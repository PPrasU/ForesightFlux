<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetunjukAPI extends Model
{
    use HasFactory;
    protected $table = 'petunjuk_api';
    protected $fillable = ['judul', 'desk_1', 'desk_2', 'desk_3', 'gambar'];
}
