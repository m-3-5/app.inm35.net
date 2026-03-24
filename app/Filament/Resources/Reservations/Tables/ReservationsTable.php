<?php

namespace App\Filament\Resources\Reservations\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

// 🚀 IL SEGRETO DI FILAMENT V4: Tutte le azioni ora vivono qui!
use Filament\Actions\Action; // Il bottone personalizzato
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

use App\Models\GuestDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ReservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('apartment.name')
                    ->label('Appartamento')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('guest_name')
                    ->label('Ospite')
                    ->searchable(),
                TextColumn::make('check_in')
                    ->label('Arrivo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('check_out')
                    ->label('Partenza')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('token')
                    ->label('Token Segreto')
                    ->copyable()
                    ->color('success'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // IL NOSTRO TASTO AZZURRO (Ora con il namespace corretto!)
                Action::make('vedi_documenti')
                    ->label('Documenti')
                    ->icon('heroicon-o-identification')
                    ->color('info')
                    ->modalHeading('Documenti per la Polizia')
                    ->modalSubmitAction(false) // Nasconde il tasto conferma, non serve
                    ->modalCancelActionLabel('Chiudi')
                    ->modalContent(function ($record) {
                        $docs = GuestDocument::where('reservation_id', $record->id)->get();
                        
                        if ($docs->isEmpty()) {
                            return new HtmlString('<p class="text-gray-500 italic">L\'ospite non ha ancora caricato i documenti.</p>');
                        }
                        
                        $html = '<div class="space-y-3">';
                        foreach ($docs as $index => $doc) {
                            $numero = $index + 1;
                            $url = Storage::url($doc->file_path);
                            $html .= "<a href='{$url}' target='_blank' style='display: block; padding: 12px; background-color: #eff6ff; color: #1d4ed8; border-radius: 8px; text-decoration: none; font-weight: bold;'>📄 Apri Documento {$numero}</a>";
                        }
                        $html .= '</div>';
                        
                        return new HtmlString($html);
                    }),

                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}