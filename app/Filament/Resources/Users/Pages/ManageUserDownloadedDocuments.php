<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use BackedEnum;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManageUserDownloadedDocuments extends ManageRelatedRecords
{
    protected static string $resource = UserResource::class;

    protected static string $relationship = 'downloadedDocuments';

    protected static ?string $title = 'Prenesena gradiva';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowDownTray;

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
}
