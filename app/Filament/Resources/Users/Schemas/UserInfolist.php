<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Osnovni podatki')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('display_name')
                            ->label('Prikazno ime'),
                        TextEntry::make('name')
                            ->label('Ime'),
                        TextEntry::make('email')
                            ->label('E-pošta'),
                        TextEntry::make('role')
                            ->label('Vloga')
                            ->badge(),
                        TextEntry::make('email_verified_at')
                            ->label('E-pošta potrjena')
                            ->dateTime('d.m.Y H:i')
                            ->placeholder('Ni potrjeno')
                            ->hintAction(
                                Action::make('confirmEmail')
                                    ->label('Potrdi')
                                    ->icon(Heroicon::OutlinedCheckBadge)
                                    ->color('success')
                                    ->requiresConfirmation()
                                    ->modalHeading('Potrdi e-poštni naslov')
                                    ->modalDescription('Ta uporabnik bo označen kot e-poštno potrjen.')
                                    ->modalSubmitActionLabel('Potrdi e-pošto')
                                    ->hidden(fn (User $record): bool => $record->hasVerifiedEmail())
                                    ->action(fn (User $record) => $record->markEmailAsVerified()),
                            ),
                        TextEntry::make('last_login_at')
                            ->label('Zadnja prijava')
                            ->dateTime('d.m.Y H:i'),
                        TextEntry::make('created_at')
                            ->label('Ustvarjen')
                            ->dateTime('d.m.Y H:i'),
                        TextEntry::make('updated_at')
                            ->label('Posodobljen')
                            ->dateTime('d.m.Y H:i'),
                    ]),
                Section::make('Avatar')
                    ->schema([
                        ImageEntry::make('avatar_url')
                            ->label('Avatar')
                            ->circular(),
                        TextEntry::make('avatar_path')
                            ->label('Pot do avatarja'),
                    ])
                    ->visible(fn (User $record): bool => filled($record->avatar_path)),
            ]);
    }
}
