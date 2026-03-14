<?php

namespace App\Console\Commands\Concerns;

use Illuminate\Support\Facades\File;

trait ResolvesSourceDirectory
{
    private function resolveSourceDirectory(string $path): ?string
    {
        if (File::isDirectory($path)) {
            return realpath($path) ?: $path;
        }

        $basePath = base_path($path);

        if (File::isDirectory($basePath)) {
            return realpath($basePath) ?: $basePath;
        }

        return null;
    }
}
