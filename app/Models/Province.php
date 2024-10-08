<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userAlamat()
    {
        return $this->hasMany(UserAlamat::class,  "provinsi_id");
    }
    public function provinsi()
    {
        return $this->hasMany(City::class,  "province_id");
    }
}
