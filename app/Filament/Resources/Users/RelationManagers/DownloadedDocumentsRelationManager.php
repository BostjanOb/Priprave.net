<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DownloadedDocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'downloadedDocuments';

    protected static ?string $title = 'Prenesena gradiva';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Gradivo')
                    ->searchable()
                    ->sortable()
                    ->limit(60),
                TextColumn::make('subject.name')
                    ->label('Predmet'),
                TextColumn::make('category.name')
                    ->label('Kategorija'),
                TextColumn::make('document_user.created_at')
                    ->label('Datum prenosa')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('document_user.created_at', 'desc')
            ->paginated([10, 25, 50]);
    }

    public function isReadOnly(): bool
    {
        return true;
    }
}
