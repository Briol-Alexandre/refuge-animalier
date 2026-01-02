<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProcessUploadedAnimalImage implements ShouldQueue
{
    use \Illuminate\Foundation\Queue\Queueable;

    public function __construct(
        public string $full_path_to_original,
        public string $new_original_file_name
    )
    {
    }

    public function handle()
    {
        $image = Image::read(
            Storage::disk('s3')->get($this->full_path_to_original)
        );

        $sizes = config('image.sizes');
        $jpeg_compression = config('image.jpeg_compression');
        $variant_pattern = config('image.variant_pattern');
        $image_type = config('image.image_type');

        foreach ($sizes as $size) {
            $variant = clone $image;
            $variant
                ->scale($size['width']);

            $path = sprintf($variant_pattern, $size['width'], $size['height']);
            Storage::disk('s3')->put($path . '/' . $this->new_original_file_name, $variant->encodeByExtension($image_type, $jpeg_compression));
        }
    }
}
