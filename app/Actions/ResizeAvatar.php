<?php

namespace App\Actions;

use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;

class ResizeAvatar
{
    public static function handle(string $path): void
    {
        Image::load($path)
            ->fit(Fit::Crop, 200, 200)
            ->save();
    }
}
