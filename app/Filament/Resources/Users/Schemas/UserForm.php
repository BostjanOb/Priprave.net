<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('display_name')
                    ->label('Prikazno ime')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->label('Ime')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('E-pošta')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Select::make('role')
                    ->label('Vloga')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'Uporabnik',
                    ])
                    ->required()
                    ->native(false),
                FileUpload::make('avatar_path')
                    ->label('Avatar')
                    ->avatar()
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->deletable()
                    ->deleteUploadedFileUsing(static fn (string $file): bool => Storage::disk('public')->delete($file)),
                Fieldset::make('Sprememba gesla')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('password')
                            ->label('Geslo')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->rule(Password::defaults())
                            ->confirmed()
                            ->dehydrated(fn (?string $state): bool => filled($state)),
                        TextInput::make('password_confirmation')
                            ->label('Potrdi geslo')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(false),
                    ]),

            ]);
    }
}
