<?php

use App\Actions\ResizeAvatar;

test('it resizes an image to 200x200', function () {
    $source = imagecreatetruecolor(800, 600);
    $path = sys_get_temp_dir().'/test-avatar-'.uniqid().'.png';
    imagepng($source, $path);
    imagedestroy($source);

    ResizeAvatar::handle($path);

    $size = getimagesize($path);
    expect($size[0])->toBe(200)
        ->and($size[1])->toBe(200);

    unlink($path);
});
