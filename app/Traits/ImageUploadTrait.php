<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageUploadTrait
{
    /**
     * Upload a single image to storage.
     *
     * @param UploadedFile|null $file The uploaded file instance
     * @param string $directory Target directory relative to disk root (e.g., 'images/users')
     * @param string $disk Storage disk name (default 'public')
     * @param string|null $preferredFilename Optional base filename without extension
     * @return string|null Stored file path relative to disk, or null if no file
     */
    protected function uploadImage(?UploadedFile $file, string $directory, string $disk = 'public', ?string $preferredFilename = null): ?string
    {
        if (!$file instanceof UploadedFile) {
            return null;
        }

        $directory = trim($directory, '/');

        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension());
        $base = $preferredFilename
            ? Str::slug(pathinfo($preferredFilename, PATHINFO_FILENAME))
            : Str::uuid()->toString();

        $filename = $base . '-' . now()->format('YmdHisv') . '.' . $extension;

        return $file->storeAs($directory, $filename, $disk);
    }

    /**
     * Upload multiple images to storage.
     *
     * @param iterable<int, UploadedFile|null> $files Array/Collection of UploadedFile
     * @param string $directory Target directory relative to disk root
     * @param string $disk Storage disk name (default 'public')
     * @return array<int, string> List of stored file paths
     */
    protected function uploadImages(iterable $files, string $directory, string $disk = 'public'): array
    {
        $paths = [];

        if ($files instanceof Collection) {
            $files = $files->all();
        }

        foreach ($files as $index => $file) {
            if (!$file instanceof UploadedFile) {
                continue;
            }

            $path = $this->uploadImage($file, $directory, $disk);
            if ($path !== null) {
                $paths[] = $path;
            }
        }

        return $paths;
    }

    /**
     * Check if a file exists on the given disk.
     */
    protected function imageExists(string $path, string $disk = 'public'): bool
    {
        $path = ltrim($path, '/');
        return Storage::disk($disk)->exists($path);
    }

    /**
     * Delete a single image if it exists.
     */
    protected function deleteImage(?string $path, string $disk = 'public'): bool
    {
        if (!$path) {
            return false;
        }

        $path = ltrim($path, '/');
        if (!Storage::disk($disk)->exists($path)) {
            return false;
        }

        return Storage::disk($disk)->delete($path);
    }

    /**
     * Delete multiple images; returns number of successfully deleted files.
     * Accepts array/collection of paths.
     */
    protected function deleteImages(iterable $paths, string $disk = 'public'): int
    {
        $deleted = 0;

        if ($paths instanceof Collection) {
            $paths = $paths->all();
        }

        foreach ($paths as $path) {
            if ($this->deleteImage($path, $disk)) {
                $deleted++;
            }
        }

        return $deleted;
    }
}