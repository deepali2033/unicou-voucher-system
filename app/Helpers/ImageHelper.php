<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get a verified image URL or fallback
     *
     * @param string|null $imagePath
     * @param string $type (job, service, plan, candidate)
     * @param string|null $fallback
     * @return string
     */
    public static function getImageUrl($imagePath, $type = 'job', $fallback = null)
    {
        // Handle null or empty paths
        if (!$imagePath) {
            return self::getFallbackImage($type, $fallback);
        }

        // Check if file exists in public storage
        $publicPath = public_path('storage/' . $imagePath);
        if (file_exists($publicPath)) {
            return asset('storage/' . $imagePath);
        }

        // Check if file exists in storage disk
        if (Storage::disk('public')->exists($imagePath)) {
            // File exists in storage but not in public - log this for sync
            \Log::warning("Image exists in storage but not public: {$imagePath}");

            // Return the URL anyway, as it should work if storage:link is configured
            return asset('storage/' . $imagePath);
        }

        // File doesn't exist anywhere - use fallback
        \Log::warning("Image file not found: {$imagePath}");
        return self::getFallbackImage($type, $fallback);
    }

    /**
     * Get fallback image based on type
     *
     * @param string $type
     * @param string|null $customFallback
     * @return string
     */
    private static function getFallbackImage($type, $customFallback = null)
    {
        if ($customFallback) {
            return asset($customFallback);
        }

        $fallbacks = [
            'job' => 'wp-content/uploads/2025/01/GettyImages-1456829834.jpg',
            'service' => 'wp-content/uploads/2025/01/pexels-jonathanborba-28576639.png',
            'plan' => 'images/service/job.jpg',
            'candidate' => 'images/service/job3.jpg'
        ];

        return asset($fallbacks[$type] ?? $fallbacks['job']);
    }

    /**
     * Verify image exists and sync if needed
     *
     * @param string $imagePath
     * @return bool
     */
    public static function verifyAndSync($imagePath)
    {
        if (!$imagePath) {
            return false;
        }

        $publicPath = public_path('storage/' . $imagePath);
        $storagePath = storage_path('app/public/' . $imagePath);

        // If exists in public, we're good
        if (file_exists($publicPath)) {
            return true;
        }

        // If exists in storage, try to copy to public
        if (file_exists($storagePath)) {
            $publicDir = dirname($publicPath);
            if (!is_dir($publicDir)) {
                mkdir($publicDir, 0755, true);
            }

            if (copy($storagePath, $publicPath)) {
                \Log::info("Synced image: {$imagePath}");
                return true;
            } else {
                \Log::error("Failed to sync image: {$imagePath}");
            }
        }

        return false;
    }

    /**
     * Get optimized image tag with fallback
     *
     * @param string|null $imagePath
     * @param string $alt
     * @param string $type
     * @param array $attributes
     * @return string
     */
    public static function imageTag($imagePath, $alt, $type = 'job', $attributes = [])
    {
        $url = self::getImageUrl($imagePath, $type);
        $fallbackUrl = self::getFallbackImage($type);

        $attrs = array_merge([
            'src' => $url,
            'alt' => $alt,
            'loading' => 'lazy',
            'onerror' => "this.src='{$fallbackUrl}'"
        ], $attributes);

        $attrString = '';
        foreach ($attrs as $key => $value) {
            $attrString .= " {$key}=\"{$value}\"";
        }

        return "<img{$attrString}>";
    }

    /**
     * Get background image CSS with fallback
     *
     * @param string|null $imagePath
     * @param string $type
     * @return string
     */
    public static function backgroundImageCss($imagePath, $type = 'job')
    {
        $url = self::getImageUrl($imagePath, $type);
        return "background-image: url('{$url}');";
    }

    /**
     * Clean up orphaned public images
     *
     * @param string $directory (images, services, plans, etc.)
     * @return array
     */
    public static function cleanupOrphans($directory)
    {
        $publicDir = public_path("storage/{$directory}");
        $storageDir = storage_path("app/public/{$directory}");

        if (!is_dir($publicDir)) {
            return ['deleted' => 0, 'errors' => []];
        }

        $deleted = 0;
        $errors = [];

        $publicFiles = glob($publicDir . '/*');
        foreach ($publicFiles as $publicFile) {
            if (is_file($publicFile)) {
                $filename = basename($publicFile);
                $correspondingStorageFile = $storageDir . '/' . $filename;

                // If file doesn't exist in storage, remove from public
                if (!file_exists($correspondingStorageFile)) {
                    if (unlink($publicFile)) {
                        $deleted++;
                        \Log::info("Deleted orphaned public image: {$directory}/{$filename}");
                    } else {
                        $errors[] = "Failed to delete: {$directory}/{$filename}";
                    }
                }
            }
        }

        return ['deleted' => $deleted, 'errors' => $errors];
    }
}
