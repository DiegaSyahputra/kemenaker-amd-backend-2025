<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    protected $fillable = ['pet_id', 'treatment_id', 'tgl_checkup', 'catatan',];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
