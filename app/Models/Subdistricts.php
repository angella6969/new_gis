<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistricts extends Model
{
    use HasFactory;
    public function desaToKecamatan()
    {
        return $this->belongsTo(Districts::class);
    }
    public function penerima()
    {
        return $this->hasMany(Penerima::class);
    }
}
