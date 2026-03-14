<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->hidden(fn (): bool => $this->getRecord()->is(Auth::user())),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $previousAvatarPath = $record->getOriginal('avatar_path');

        $record->update($data);

        if (filled($previousAvatarPath) && ($previousAvatarPath !== $record->avatar_path)) {
            Storage::disk('public')->delete($previousAvatarPath);
        }

        return $record;
    }
}
