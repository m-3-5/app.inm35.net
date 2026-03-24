<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // Sblocca la scrittura dei dati
    protected $guarded = [];

    // Collega la prenotazione all'appartamento
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}