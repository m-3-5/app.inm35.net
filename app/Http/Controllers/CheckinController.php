<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\GuestDocument;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; // IMPORTANTE: Serve per eliminare i file dal server!

class CheckinController extends Controller
{
    // 1. Mostra la pagina
    public function show($token)
    {
        $reservation = Reservation::where('token', $token)->with('apartment')->firstOrFail();

        if (Carbon::now()->isAfter($reservation->check_out)) {
            return view('checkin.expired', compact('reservation'));
        }

        // Recuperiamo tutti i documenti di questo ospite
        $documents = GuestDocument::where('reservation_id', $reservation->id)->get();

        if ($documents->isEmpty()) {
            return view('checkin.upload', [
                'reservation' => $reservation,
                'apartment' => $reservation->apartment,
            ]);
        }

        // Se ci sono documenti, li mandiamo alla pagina grafica
        return view('checkin.show', [
            'reservation' => $reservation,
            'apartment' => $reservation->apartment,
            'documents' => $documents, // Nuova riga: passiamo i documenti alla vista!
        ]);
    }

    // 2. Salva i file caricati
    public function storeDocument(Request $request, $token)
    {
        $reservation = Reservation::where('token', $token)->firstOrFail();

        $request->validate([
            'document_files' => 'required|array',
            'document_files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        foreach ($request->file('document_files') as $file) {
            $path = $file->store('documents', 'public');

            GuestDocument::create([
                'reservation_id' => $reservation->id,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('checkin.show', $token)
            ->with('success', 'Documenti ricevuti e verificati con successo! Il check-in è sbloccato.');
    }

    // 3. NUOVA FUNZIONE: Elimina un documento caricato per errore
    public function destroyDocument($token, $id)
    {
        $reservation = Reservation::where('token', $token)->firstOrFail();
        
        // Trova il documento assicurandosi che sia di questa prenotazione
        $document = GuestDocument::where('reservation_id', $reservation->id)->findOrFail($id);

        // A. Elimina fisicamente il file dal server
        Storage::disk('public')->delete($document->file_path);

        // B. Elimina la traccia dal database
        $document->delete();

        // Ricarica la pagina mostrando un avviso
        return redirect()->route('checkin.show', $token)
            ->with('success', 'Documento rimosso correttamente.');
    }
}