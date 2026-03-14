<?php

namespace App\Console\Commands;

use App\Console\Commands\Concerns\ResolvesSourceDirectory;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportUserAvatarsCommand extends Command
{
    use ResolvesSourceDirectory;

    protected $signature = 'app:import-user-avatars {path : Path to a directory containing ID.png avatar files}';

    protected $description = 'Import user avatars from a directory of ID.png files';

    public function handle(): int
    {
        $sourceDirectory = $this->resolveSourceDirectory((string) $this->argument('path'));

        if ($sourceDirectory === null) {
            $this->error('The provided avatar directory does not exist.');

            return self::FAILURE;
        }

        $importedCount = 0;
        $skippedCount = 0;

        foreach (File::files($sourceDirectory) as $file) {
            if (! $this->isImportableAvatarFile($file->getFilename())) {
                $skippedCount++;

                continue;
            }

            $userId = (int) $file->getFilenameWithoutExtension();
            $user = User::find($userId);

            if (! $user) {
                $this->warn("Skipping {$file->getFilename()}: user {$userId} was not found.");
                $skippedCount++;

                continue;
            }

            $avatarPath = $this->storeAvatar($file->getPathname());

            if (filled($user->avatar_path) && ($user->avatar_path !== $avatarPath)) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $user->forceFill([
                'avatar_path' => $avatarPath,
            ])->save();

            $importedCount++;
        }

        $this->info("Imported {$importedCount} avatar(s).");
        $this->info("Skipped {$skippedCount} file(s).");

        return self::SUCCESS;
    }

    private function isImportableAvatarFile(string $filename): bool
    {
        return (bool) preg_match('/^\d+\.png$/i', $filename);
    }

    private function storeAvatar(string $sourcePath): string
    {
        return Storage::disk('public')->putFileAs(
            'avatars',
            new HttpFile($sourcePath),
            Str::ulid().'.png',
        );
    }
}
