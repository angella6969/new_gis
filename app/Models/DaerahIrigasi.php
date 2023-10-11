<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class DaerahIrigasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function penerima()
    {
        return $this->hasMany(Penerima::class);
    }
}
