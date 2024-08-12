<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';
    protected $guarded = [];
    public function kota()
    {
        return $this->belongsTo(City::class,  "city_id");
    }
    public function provinsi()
    {
        return $this->belongsTo(Province::class,  "province_id");
    }
}
