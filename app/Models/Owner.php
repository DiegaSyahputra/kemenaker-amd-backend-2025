<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ['nama', 'no_telp', 'verifikasi_no_telp','email', 'alamat'];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
