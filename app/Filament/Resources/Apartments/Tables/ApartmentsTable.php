<?php

namespace App\Filament\Resources\Apartments\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class ApartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome Appartamento')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('whatsapp_number')
                    ->label('WhatsApp'),
                TextColumn::make('default_checkin_hour')
                    ->label('Orario Check-in')
                    ->time('H:i'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}