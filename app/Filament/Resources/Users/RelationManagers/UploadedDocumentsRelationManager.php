<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UploadedDocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    protected static ?string $title = 'Naložena gradiva';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Naslov')
                    ->searchable()
                    ->sortable()
                    ->limit(60),
                TextColumn::make('subject.name')
                    ->label('Predmet')
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Kategorija'),
                TextColumn::make('downloads_count')
                    ->label('Prenosi')
                    ->sortable(),
                TextColumn::make('views_count')
                    ->label('Ogledi')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Datum')
                    ->dateTime('d.m.Y')
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
