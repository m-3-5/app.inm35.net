<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestDocument extends Model
{
    protected $guarded = [];

    // Collega il documento alla prenotazione
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}