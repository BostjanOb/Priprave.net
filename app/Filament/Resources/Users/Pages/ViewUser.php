<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Filament\Resources\Users\Widgets\UserStatsOverview;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use STS\FilamentImpersonate\Actions\Impersonate;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Impersonate::make()->record($this->getRecord()),
            EditAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserStatsOverview::make(['record' => $this->getRecord()]),
        ];
    }

    public function confirmEmail(): void
    {
        $user = $this->getRecord();

        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->markEmailAsVerified();

        Notification::make()
            ->success()
            ->title('E-poštni naslov je potrjen.')
            ->send();
    }
}
