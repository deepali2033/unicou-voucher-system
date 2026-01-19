<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SyncStorageImages extends Command
{
    protected $signature = 'storage:sync-images {--force : Force sync even if files exist}';
    protected $description = 'Sync all images from storage/app/public to public/storage';

    public function handle()
    {
        $this->info('Starting comprehensive image sync...');

        $directories = [
            'images' => 'Job Images',
            'services' => 'Service Images',
            'plans' => 'Plan Images',
            'candidates' => 'Candidate Files'
        ];

        $totalCopied = 0;
        $totalSkipped = 0;
        $totalErrors = 0;

        foreach ($directories as $dir => $description) {
            $this->line("\nSyncing {$description} ({$dir})...");

            $sourcePath = storage_path("app/public/{$dir}");
            $publicPath = public_path("storage/{$dir}");

            if (!File::isDirectory($sourcePath)) {
                $this->warn("Source directory does not exist: {$sourcePath} - Skipping");
                continue;
            }

            // Create destination directory
            if (!File::isDirectory($publicPath)) {
                File::makeDirectory($publicPath, 0755, true);
                $this->info("Created directory: {$publicPath}");
            }

            $files = File::allFiles($sourcePath);
            $dirCopied = 0;
            $dirSkipped = 0;
            $dirErrors = 0;

            foreach ($files as $file) {
                $relativePath = $file->getRelativePath();
                $filename = $file->getFilename();
                $sourceFile = $file->getRealPath();

                // Build destination path
                $destDir = $publicPath . ($relativePath ? DIRECTORY_SEPARATOR . $relativePath : '');
                $destFile = $destDir . DIRECTORY_SEPARATOR . $filename;

                // Create subdirectories
                if (!File::isDirectory($destDir)) {
                    File::makeDirectory($destDir, 0755, true);
                }

                // Check if should skip
                if (!$this->option('force') && File::exists($destFile)) {
                    if (File::lastModified($destFile) >= File::lastModified($sourceFile)) {
                        $dirSkipped++;
                        continue;
                    }
                }

                // Copy file
                if (File::copy($sourceFile, $destFile)) {
                    $dirCopied++;
                    $this->info("✓ Copied: {$relativePath}/{$filename}");
                } else {
                    $dirErrors++;
                    $this->error("✗ Failed: {$relativePath}/{$filename}");
                }
            }

            $this->line("{$description}: {$dirCopied} copied, {$dirSkipped} skipped, {$dirErrors} errors");

            $totalCopied += $dirCopied;
            $totalSkipped += $dirSkipped;
            $totalErrors += $dirErrors;
        }

        $this->newLine();
        $this->info("Sync completed!");
        $this->table(
            ['Status', 'Count'],
            [
                ['Copied', $totalCopied],
                ['Skipped', $totalSkipped],
                ['Errors', $totalErrors]
            ]
        );

        // Verify storage link
        $this->checkStorageLink();

        return $totalErrors > 0 ? 1 : 0;
    }

    private function checkStorageLink()
    {
        $publicStorage = public_path('storage');

        if (!File::exists($publicStorage)) {
            $this->warn('Storage symlink does not exist!');
            $this->info('Run: php artisan storage:link');
            return;
        }

        if (is_link($publicStorage)) {
            $this->info('✓ Storage symlink exists and is working');
        } else {
            $this->info('✓ Storage directory exists (manual setup)');
        }
    }
}
