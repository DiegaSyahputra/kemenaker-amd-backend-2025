<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = ['nama', 'tipe', 'deskripsi', 'harga'];

    public function checkups()
    {
        return $this->hasMany(Checkup::class);
    }
}
