<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    public function process(UploadedFile $file, string $type, array $options = []): string
    {
        $this->validate($file);

        $basename = Str::uuid()->toString();
        $disk = 'public';

        // directorios
        $basePath = "{$type}";
        $paths = [
            'original' => "{$basePath}/original/{$basename}",
            'large' => "{$basePath}/large/{$basename}",
            'thumb' => "{$basePath}/thumb/{$basename}",
        ];

        // imagen original -> webp y jpg
        $original = Image::read($file->getRealPath());
        $this->saveFormatsFromImage($original, $paths['original'], 90, $disk);

        // large
        $large = Image::read($file->getRealPath());
        $largeWidth = $options['large']['width'] ?? 1600;
        $largeHeight = $options['large']['height'] ?? 1600;
        $largeMode = $options['large']['mode'] ?? 'scaleDown';
        $large = $largeMode === 'cover'
            ? $large->cover($largeWidth, $largeHeight)
            : $large->scaleDown($largeWidth, $largeHeight);
        $this->saveFormatsFromImage($large, $paths['large'], 85, $disk);

        // thumb 400x400 (customizable)
        $thumb = Image::read($file->getRealPath());
        $thumbWidth = $options['thumb']['width'] ?? 400;
        $thumbHeight = $options['thumb']['height'] ?? 400;
        $thumbMode = $options['thumb']['mode'] ?? 'cover';
        $thumb = $thumbMode === 'cover'
            ? $thumb->cover($thumbWidth, $thumbHeight)
            : $thumb->scaleDown($thumbWidth, $thumbHeight);
        $this->saveFormatsFromImage($thumb, $paths['thumb'], 72, $disk);

        return $basename;
    }

    public function delete(string $basename, string $type): void
    {
        $disk = 'public';
        foreach (['original', 'large', 'thumb'] as $size) {
            foreach (['webp', 'jpg'] as $ext) {
                $path = "{$type}/{$size}/{$basename}.{$ext}";
                if (Storage::disk($disk)->exists($path)) {
                    Storage::disk($disk)->delete($path);
                }
            }
        }
    }

    protected function validate(UploadedFile $file): void
    {
        if (!in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/webp'])) {
            abort(422, 'Formato de imagen no permitido');
        }
        if ($file->getSize() > 2 * 1024 * 1024) {
            abort(422, 'Imagen excede el límite de 2MB');
        }
    }

    protected function saveFormatsFromImage(ImageInterface $image, string $basePath, int $quality, string $disk): void
    {
        $webp = $image->encode(new WebpEncoder(quality: $quality));
        $jpg = $image->encode(new JpegEncoder(quality: $quality));

        Storage::disk($disk)->put("{$basePath}.webp", $webp);
        Storage::disk($disk)->put("{$basePath}.jpg", $jpg);
    }
}
