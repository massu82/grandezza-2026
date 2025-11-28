<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    public function process(UploadedFile $file, string $type): string
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
        $this->saveFormats($file->getRealPath(), $paths['original'], 90, $disk);

        // large
        $large = Image::read($file->getRealPath())->scaleDown(1600, 1600)->encode();
        $this->saveFormatsFromImage($large, $paths['large'], 85, $disk);

        // thumb 400x400
        $thumb = Image::read($file->getRealPath())->cover(400, 400)->encode();
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
        if ($file->getSize() > 1024 * 1024) {
            abort(422, 'Imagen excede el límite de 1MB');
        }
    }

    protected function saveFormats(string $sourcePath, string $basePath, int $quality, string $disk): void
    {
        $image = Image::read($sourcePath);
        $this->saveFormatsFromImage($image, $basePath, $quality, $disk);
    }

    protected function saveFormatsFromImage($image, string $basePath, int $quality, string $disk): void
    {
        Storage::disk($disk)->put("{$basePath}.webp", $image->toWebp($quality));
        Storage::disk($disk)->put("{$basePath}.jpg", $image->toJpeg($quality));
    }
}
