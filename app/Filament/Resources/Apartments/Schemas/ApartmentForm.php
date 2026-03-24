<?php

namespace App\Filament\Resources\Apartments\Schemas;

// Importiamo la Struttura (Schemas)
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

// Importiamo i Campi di Testo (Forms)
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;

class ApartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dati Principali')
                    ->description('Informazioni base e contatti.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome Appartamento')
                            ->required(), //
                        TextInput::make('whatsapp_number')
                            ->label('WhatsApp')
                            ->tel(), //
                        TextInput::make('address')
                            ->label('Indirizzo / Parcheggio')
                            ->columnSpanFull(), //
                    ])->columns(2),

                Section::make('Logica di Accesso')
                    ->description('Dati necessari per il self check-in.')
                    ->schema([
                        TextInput::make('checkin_video_url')
                            ->label('Video YouTube/Vimeo')
                            ->url(), //
                        TextInput::make('access_code')
                            ->label('Codice PIN'), //
                        TimePicker::make('default_checkin_hour')
                            ->label('Orario Check-in')
                            ->default('16:00'), //
                    ])->columns(3),

                Section::make('Regole e Info')
                    ->description('Testi visibili agli ospiti.')
                    ->schema([
                        RichEditor::make('house_rules')
                            ->label('Regole della Casa'), //
                        RichEditor::make('stay_info')
                            ->label('Info Soggiorno'), //
                        RichEditor::make('checkout_info')
                            ->label('Istruzioni Check-out'), //
                    ]),
            ]);
    }
}