<?php

namespace App\Filament\Resources\Documents\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DownloadRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'downloadRecords';

    protected static ?string $title = 'Prenosi';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.display_name')
                    ->label('Uporabnik')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Datum prenosa')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }

    public function isReadOnly(): bool
    {
        return true;
    }
}
