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
     * - Lưu theo cấu trúc Y/m/d nếu $byDate = true
     *
     * @param UploadedFile|null $file
     * @param string $directory  Base directory (e.g. 'images/users')
     * @param string $disk       Storage disk name (default 'public')
     * @param string|null $preferredFilename  Base filename (without ext)
     * @param bool $byDate       Append date folders Y/m/d
     * @return string|null       Stored path relative to disk
     */
    protected function uploadImage(
        ?UploadedFile $file,
        string $directory,
        string $disk = 'public',
        ?string $preferredFilename = null,
        bool $byDate = true
    ): ?string {
        if (!$file instanceof UploadedFile) {
            return null;
        }

        $directory = trim($directory, '/');
        if ($byDate) {
            $directory .= '/' . now()->format('Y/m/d');
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: ($file->extension() ?: $file->guessExtension() ?: 'bin'));

        $base = $preferredFilename
            ? Str::slug(pathinfo($preferredFilename, PATHINFO_FILENAME))
            : Str::uuid()->toString();

        // Tên ngắn, đủ uniqueness: base-YYYYMMDDHHIISS-rand6.ext
        $filename = sprintf(
            '%s-%s-%s.%s',
            $base,
            now()->format('YmdHis'),
            Str::lower(Str::random(6)),
            $extension
        );

        return $file->storeAs($directory, $filename, $disk);
    }

    /**
     * Upload multiple images to storage.
     *
     * @param iterable<int, UploadedFile|null> $files
     * @param string $directory
     * @param string $disk
     * @param bool $byDate
     * @return array<int, string>
     */
    protected function uploadImages(iterable $files, string $directory, string $disk = 'public', bool $byDate = true): array
    {
        $paths = [];

        if ($files instanceof Collection) {
            $files = $files->all();
        }

        foreach ($files as $file) {
            if (!$file instanceof UploadedFile) {
                continue;
            }
            $path = $this->uploadImage($file, $directory, $disk, null, $byDate);
            if ($path !== null) {
                $paths[] = $path;
            }
        }

        return $paths;
    }

    /**
     * Replace old image by uploading a new one, then delete the old file.
     *
     * @return string|null New path or null if no new file
     */
    protected function replaceImage(?string $oldPath, ?UploadedFile $file, string $directory, string $disk = 'public', ?string $preferredFilename = null, bool $byDate = true): ?string
    {
        $newPath = $this->uploadImage($file, $directory, $disk, $preferredFilename, $byDate);
        if ($newPath && $oldPath) {
            $this->deleteImage($oldPath, $disk);
        }
        return $newPath;
    }

    /**
     * Get public URL for a stored image path.
     */
    protected function imageUrl(?string $path, string $disk = 'public'): ?string
    {
        if (!$path) {
            return null;
        }
        $path = ltrim($path, '/');
        return Storage::disk($disk)->url($path);
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
