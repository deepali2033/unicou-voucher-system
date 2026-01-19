<?php

/**
 * Storage Sync Script
 *
 * This script ensures that files in storage/app/public are properly
 * accessible through public/storage by creating a directory copy
 * when symbolic links aren't available.
 */

require_once 'vendor/autoload.php';

try {
    echo "Starting storage sync...\n";

    $sourceDir = __DIR__ . '/storage/app/public';
    $targetDir = __DIR__ . '/public/storage';

    // Function to copy directory recursively
    function copyDirectory($source, $target) {
        if (!is_dir($source)) {
            echo "Source directory does not exist: $source\n";
            return false;
        }

        // Create target directory if it doesn't exist
        if (!is_dir($target)) {
            mkdir($target, 0755, true);
            echo "Created directory: $target\n";
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($files as $file) {
            $relativePath = substr($file->getPathname(), strlen($source));
            $targetPath = $target . $relativePath;

            if ($file->isDir()) {
                if (!is_dir($targetPath)) {
                    mkdir($targetPath, 0755, true);
                    echo "Created directory: $targetPath\n";
                }
            } else {
                $sourceTime = filemtime($file->getPathname());
                $targetExists = file_exists($targetPath);
                $targetTime = $targetExists ? filemtime($targetPath) : 0;

                // Copy if target doesn't exist or source is newer
                if (!$targetExists || $sourceTime > $targetTime) {
                    copy($file->getPathname(), $targetPath);
                    echo "Copied: $relativePath\n";
                }
            }
        }

        return true;
    }

    // Sync storage directories
    if (copyDirectory($sourceDir, $targetDir)) {
        echo "✅ Storage sync completed successfully!\n";

        // Show plans directory status
        $plansSource = $sourceDir . '/plans';
        $plansTarget = $targetDir . '/plans';

        if (is_dir($plansSource)) {
            $sourceFiles = array_diff(scandir($plansSource), ['.', '..', '.gitignore']);
            $targetFiles = is_dir($plansTarget) ? array_diff(scandir($plansTarget), ['.', '..', '.gitignore']) : [];

            echo "\nPlans directory status:\n";
            echo "- Source files: " . count($sourceFiles) . "\n";
            echo "- Target files: " . count($targetFiles) . "\n";

            if (count($sourceFiles) > 0) {
                echo "- Files: " . implode(', ', $sourceFiles) . "\n";
            }
        }
    } else {
        echo "❌ Storage sync failed!\n";
        exit(1);
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
