<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilter($query, array $Filters)
    {
        $query->when($Filters['search'] ?? false, function ($query, $search) {
            return $query->where('daerah_irigasis.nama', 'LIKE', '%' . strtolower($search) . '%');
        });
    }
    public function progres()
    {
        return $this->hasMany(Progres::class);
    }
    public function daerahIrigasi()
    {
        return $this->belongsTo(DaerahIrigasi::class);
    }
    public function map_Gis()
    {
        return $this->belongsTo(map_Gis::class);
    }
    public function provinsi()
    {
        return $this->belongsTo(Province::class);
    }
    public function kabupaten()
    {
        return $this->belongsTo(Cities::class, 'city_id');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Districts::class,'district_id');
    }
    public function desa()
    {
        return $this->belongsTo(Subdistricts::class,'subdistrict_id');
    }
}
