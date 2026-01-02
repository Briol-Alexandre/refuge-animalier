<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProcessUploadedUserAvatar implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $full_path_to_original,
        public string $new_original_file_name
    )
    {
    }

    public function handle()
    {
        $imageContent = Storage::disk('s3')->get($this->full_path_to_original);

        $image = Image::make($imageContent);


        $sizes = config('avatar.sizes');
        $jpeg_compression = config('avatar.jpeg_compression');
        $variant_pattern = config('avatar.variant_pattern');
        $image_type = config('avatar.image_type');

        foreach ($sizes as $size) {
            $variant = clone $image;
            $variant
                ->scale($size['width']);

            $path = sprintf($variant_pattern, $size['width'], $size['height']);
            Storage::put($path . '/' . $this->new_original_file_name, $variant->encodeByExtension($image_type, $jpeg_compression));
        }
    }
}
