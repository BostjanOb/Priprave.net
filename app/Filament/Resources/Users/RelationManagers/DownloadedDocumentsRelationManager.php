<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DownloadedDocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'downloadRecords';

    protected static ?string $title = 'Prenesena gradiva';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('document.title')
                    ->label('Gradivo')
                    ->searchable()
                    ->sortable()
                    ->limit(60),
                TextColumn::make('document.subject.name')
                    ->label('Predmet'),
                TextColumn::make('document.category.name')
                    ->label('Kategorija'),
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
