<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = ['kode_registrasi', 'owner_id', 'nama', 'jenis', 'usia', 'berat'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function checkups()
    {
        return $this->hasMany(Checkup::class);
    }

    public static function generateKodeRegistrasi(int $ownerId): string
    {
        $hhmm    = now()->format('Hi');
        $ownerPad = str_pad($ownerId, 4, '0', STR_PAD_LEFT);
        $sequence = self::count() + 1;
        $seqPad   = str_pad($sequence, 4, '0', STR_PAD_LEFT);

        $code = $hhmm . $ownerPad . $seqPad;

        while (self::where('kode_registrasi', $code)->exists()) {
            $sequence++;
            $seqPad = str_pad($sequence, 4, '0', STR_PAD_LEFT);
            $code   = $hhmm . $ownerPad . $seqPad;
        }

        return $code;
    }
}
