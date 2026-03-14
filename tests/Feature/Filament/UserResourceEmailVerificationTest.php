<?php

use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create(['role' => 'admin']));
});

it('does not show email verification on the edit form', function () {
    $user = User::factory()->create();

    Livewire::test(EditUser::class, ['record' => $user->getRouteKey()])
        ->assertFormFieldDoesNotExist('email_verified_at');
});

it('allows confirming email from the user infolist', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    Livewire::test(ViewUser::class, ['record' => $user->getRouteKey()])
        ->assertSchemaComponentExists('email_verified_at')
        ->assertSee('Potrdi')
        ->call('confirmEmail')
        ->assertNotified();

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});

it('hides the confirm email action for verified users', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    Livewire::test(ViewUser::class, ['record' => $user->getRouteKey()])
        ->assertDontSee('Potrdi');
});
