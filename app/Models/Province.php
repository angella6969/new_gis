<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public function kabupatenToProvinsi()
    {
        return $this->hasMany(Cities::class);
    }
    public function penerima()
    {
        return $this->hasMany(Penerima::class);
    }
}
