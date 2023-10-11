<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    public function provinsiToKabupaten()
    {
        return $this->belongsTo(Province::class);
    }
    public function kecamatanToKabupaten()
    {
        return $this->hasMany(Districts::class);
    }
    public function penerima()
    {
        return $this->hasMany(Penerima::class);
    }
}
