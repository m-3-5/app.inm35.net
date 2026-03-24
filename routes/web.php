<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckinController;

// Rotta predefinita (Homepage vuota per ora)
Route::get('/', function () {
    return view('welcome');
});

// La nostra rotta magica per gli ospiti (Mostra la pagina)
Route::get('/checkin/{token}', [CheckinController::class, 'show'])->name('checkin.show');

// LA NUOVA ROTTA: Riceve il documento caricato dall'ospite e lo salva sul server
Route::post('/checkin/{token}/upload', [CheckinController::class, 'storeDocument'])->name('checkin.upload');

// Rotta per ELIMINARE un documento
Route::delete('/checkin/{token}/document/{id}', [CheckinController::class, 'destroyDocument'])->name('checkin.document.destroy');

Route::get('/test-mail', function () {
    try {
        // Prova a mandare una mail semplicissima
        \Illuminate\Support\Facades\Mail::raw('Questo è un test di funzionamento SMTP di Laravel.', function ($message) {
            $message->to('info@inm35.net') // Manderà l'email a te stesso
                    ->subject('Test di sistema INM35');
        });
        return '<h1>✅ SUCCESSO! L\'email è partita.</h1><p>Controlla la casella info@inm35.net (anche nello Spam).</p>';
    } catch (\Exception $e) {
        // Se fallisce, ci dice esattamente il PERCHÉ
        return '<h1>❌ ERRORE DI INVIO:</h1><p style="color:red;">' . $e->getMessage() . '</p>';
    }
});