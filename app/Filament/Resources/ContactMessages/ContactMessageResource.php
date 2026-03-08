<?php

namespace App\Filament\Resources\ContactMessages;

use App\Filament\Resources\ContactMessages\Pages\ManageContactMessages;
use App\Mail\ContactMessageReplyMail;
use App\Models\ContactMessage;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $modelLabel = 'Sporočilo';

    protected static ?string $pluralModelLabel = 'Sporočila';

    protected static ?string $navigationLabel = 'Kontaktna sporočila';

    protected static ?int $navigationSort = 30;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Ime')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-pošta')
                    ->searchable(),
                TextColumn::make('subject')
                    ->label('Zadeva')
                    ->searchable()
                    ->limit(50),
                IconColumn::make('replied_at')
                    ->label('Odgovorjeno')
                    ->boolean()
                    ->getStateUsing(fn (ContactMessage $record): bool => $record->isReplied()),
                TextColumn::make('created_at')
                    ->label('Prejeto')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('unanswered')
                    ->label('Neodgovorjeno')
                    ->query(fn (Builder $query): Builder => $query->whereNull('replied_at')),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('reply')
                    ->label('Odgovori')
                    ->icon(Heroicon::ChatBubbleLeftRight)
                    ->color('success')
                    ->visible(fn (ContactMessage $record): bool => ! $record->isReplied())
                    ->schema([
                        MarkdownEditor::make('reply_message')
                            ->label('Odgovor')
                            ->required(),
                    ])
                    ->action(function (array $data, ContactMessage $record): void {
                        $record->update([
                            'reply_message' => $data['reply_message'],
                            'replied_at' => now(),
                            'replied_by' => Auth::id(),
                        ]);

                        Mail::to($record->email)->send(new ContactMessageReplyMail($record));

                        Notification::make()
                            ->title('Odgovor poslan')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Sporočilo')
                ->schema([
                    TextEntry::make('name')->label('Ime'),
                    TextEntry::make('email')->label('E-pošta'),
                    TextEntry::make('subject')->label('Zadeva'),
                    TextEntry::make('message')
                        ->label('Sporočilo')
                        ->prose()
                        ->columnSpanFull(),
                    TextEntry::make('created_at')
                        ->label('Prejeto'),
                ]),
            Callout::make('Ni odgovora')
                ->description('Na sporočilo ni bilo odgovora.')
                ->info()
                ->hidden(fn (ContactMessage $record): bool => $record->isReplied()),
            Section::make('Odgovor')
                ->schema([
                    TextEntry::make('reply_message')
                        ->label('Odgovor')
                        ->prose()
                        ->columnSpanFull(),
                    TextEntry::make('repliedBy.name')
                        ->label('Odgovoril/a'),
                    TextEntry::make('replied_at')
                        ->label('Odgovorjeno')
                        ->dateTime('d.m.Y H:i'),
                ])
                ->visible(fn (ContactMessage $record): bool => $record->isReplied()),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageContactMessages::route('/'),
        ];
    }
}
