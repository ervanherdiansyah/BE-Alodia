<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $guarded = [];
    public function userAlamat()
    {
        return $this->hasMany(UserAlamat::class,  "kota_id");
    }
    public function provinsi()
    {
        return $this->belongsTo(Province::class,  "province_id");
    }
    public function kecamatan()
    {
        return $this->belongsTo(Subdistrict::class,  "city_id");
    }
}
