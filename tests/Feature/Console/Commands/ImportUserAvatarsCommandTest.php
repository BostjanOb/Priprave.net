<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('imports user avatars from a directory and replaces existing avatars', function () {
    Storage::fake('public');

    $user = User::factory()->create([
        'avatar_path' => 'avatars/old-avatar.png',
    ]);

    Storage::disk('public')->put($user->avatar_path, 'old avatar');

    $missingUserId = $user->id + 10_000;
    $sourceDirectory = createTempAvatarDirectory();

    try {
        createTestPngImage("{$sourceDirectory}/{$user->id}.png");
        createTestPngImage("{$sourceDirectory}/{$missingUserId}.png");
        File::put("{$sourceDirectory}/invalid-name.png", 'invalid');

        $this->artisan('app:import-user-avatars', ['path' => $sourceDirectory])
            ->expectsOutputToContain('Imported 1 avatar(s).')
            ->expectsOutputToContain('Skipped 2 file(s).')
            ->assertSuccessful();

        $user->refresh();

        expect($user->avatar_path)->not->toBe('avatars/old-avatar.png')
            ->and($user->avatar_path)->toStartWith('avatars/');

        Storage::disk('public')->assertMissing('avatars/old-avatar.png');
        Storage::disk('public')->assertExists($user->avatar_path);
    } finally {
        File::deleteDirectory($sourceDirectory);
    }
});

it('fails when the provided avatar directory does not exist', function () {
    $this->artisan('app:import-user-avatars', ['path' => 'missing-avatars-directory'])
        ->expectsOutput('The provided avatar directory does not exist.')
        ->assertExitCode(1);
});

function createTempAvatarDirectory(): string
{
    $directory = sys_get_temp_dir().'/avatars-import-'.str_replace('.', '', uniqid('', true));

    File::makeDirectory($directory, 0755, true);

    return $directory;
}

function createTestPngImage(string $path, int $width = 400, int $height = 300): void
{
    $image = imagecreatetruecolor($width, $height);
    imagepng($image, $path);
    imagedestroy($image);
}
