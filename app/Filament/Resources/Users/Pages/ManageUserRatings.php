<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use BackedEnum;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManageUserRatings extends ManageRelatedRecords
{
    protected static string $resource = UserResource::class;

    protected static string $relationship = 'ratings';

    protected static ?string $title = 'Ocene';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

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
                TextColumn::make('rating')
                    ->label('Ocena')
                    ->sortable()
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state).str_repeat('☆', 5 - $state)),
                TextColumn::make('created_at')
                    ->label('Datum')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}
