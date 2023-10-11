<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    public function kabupatenToKecamatan()
    {
        return $this->belongsTo(Cities::class);
    }
    public function kecamatanToDesa()
    {
        return $this->hasMany(Subdistricts::class);
    }
    public function penerima()
    {
        return $this->hasMany(Penerima::class);
    }
}
