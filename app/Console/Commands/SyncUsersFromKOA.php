<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class SyncUsersFromKOA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:sync-from-koa
                            {--dry-run : Show what would be synced without actually syncing}
                            {--force : Force sync without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync users from KOA database to KOA_services database, updating all columns to match exactly';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Test connections
            $this->info('Testing database connections...');

            // Test KOA_services connection
            try {
                DB::connection('mysql')->getPdo();
                $this->info('✓ Connected to KOA_services database');
            } catch (Exception $e) {
                $this->error('✗ Failed to connect to KOA_services database: ' . $e->getMessage());
                return 1;
            }

            // Test KOA connection
            try {
                DB::connection('koa_source')->getPdo();
                $this->info('✓ Connected to KOA database');
            } catch (Exception $e) {
                $this->error('✗ Failed to connect to KOA database: ' . $e->getMessage());
                return 1;
            }

            // Get source users from KOA database
            $this->info('Fetching users from KOA database...');
            $sourceUsers = DB::connection('koa_source')->table('users')->get();

            if ($sourceUsers->isEmpty()) {
                $this->warn('No users found in KOA database.');
                return 0;
            }

            $this->info('Found ' . $sourceUsers->count() . ' users in KOA database.');

            // Get existing users from KOA_services database for comparison
            $existingUsers = User::all()->keyBy('id');

            $this->info('Found ' . $existingUsers->count() . ' existing users in KOA_services database.');

            // Prepare sync statistics
            $toCreate = collect();
            $toUpdate = collect();
            $unchanged = 0;

            // Analyze what needs to be synced
            foreach ($sourceUsers as $sourceUser) {
                $existingUser = $existingUsers->get($sourceUser->id);

                if (!$existingUser) {
                    $toCreate->push($sourceUser);
                } else {
                    // Check if update is needed by comparing all fields
                    if ($this->needsUpdate($sourceUser, $existingUser)) {
                        $toUpdate->push(['source' => $sourceUser, 'existing' => $existingUser]);
                    } else {
                        $unchanged++;
                    }
                }
            }

            // Display sync summary
            $this->info("\n--- Sync Summary ---");
            $this->info("Users to create: " . $toCreate->count());
            $this->info("Users to update: " . $toUpdate->count());
            $this->info("Users unchanged: " . $unchanged);

            if ($this->option('dry-run')) {
                $this->warn("\n--- DRY RUN MODE ---");
                $this->showDetails($toCreate, $toUpdate);
                $this->info('This was a dry run. No changes were made.');
                return 0;
            }

            // Confirm before proceeding (unless forced)
            if (!$this->option('force')) {
                if (!$this->confirm('Do you want to proceed with the sync?')) {
                    $this->info('Sync cancelled.');
                    return 0;
                }
            }

            // Start the sync process
            $this->info("\n--- Starting Sync ---");

            DB::beginTransaction();

            try {
                // Create new users
                if ($toCreate->count() > 0) {
                    $this->info('Creating ' . $toCreate->count() . ' new users...');
                    $bar = $this->output->createProgressBar($toCreate->count());

                    foreach ($toCreate as $sourceUser) {
                        $this->createUser($sourceUser);
                        $bar->advance();
                    }
                    $bar->finish();
                    $this->info('');
                }

                // Update existing users
                if ($toUpdate->count() > 0) {
                    $this->info('Updating ' . $toUpdate->count() . ' existing users...');
                    $bar = $this->output->createProgressBar($toUpdate->count());

                    foreach ($toUpdate as $userPair) {
                        $this->updateUser($userPair['source'], $userPair['existing']);
                        $bar->advance();
                    }
                    $bar->finish();
                    $this->info('');
                }

                DB::commit();

                $this->info("✓ User sync completed successfully!");
                $this->info("Created: " . $toCreate->count() . " users");
                $this->info("Updated: " . $toUpdate->count() . " users");
                $this->info("Unchanged: " . $unchanged . " users");

            } catch (Exception $e) {
                DB::rollBack();
                $this->error('✗ Sync failed: ' . $e->getMessage());
                return 1;
            }

        } catch (Exception $e) {
            $this->error('✗ Command failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Check if a user needs to be updated
     */
    private function needsUpdate($sourceUser, $existingUser): bool
    {
        // Get all fillable fields from the User model
        $fillableFields = (new User())->getFillable();

        // Add some standard fields that should also be synced
        $fieldsToCheck = array_merge($fillableFields, [
            'id', 'email', 'email_verified_at', 'password', 'remember_token',
            'created_at', 'updated_at'
        ]);

        foreach ($fieldsToCheck as $field) {
            // Skip password comparison for security
            if ($field === 'password') {
                continue;
            }

            $sourceValue = $sourceUser->$field ?? null;
            $existingValue = $existingUser->$field ?? null;

            // Handle datetime comparison
            if (in_array($field, ['created_at', 'updated_at', 'email_verified_at', 'verified_at'])) {
                $sourceValue = $sourceValue ? date('Y-m-d H:i:s', strtotime($sourceValue)) : null;
                $existingValue = $existingValue ? date('Y-m-d H:i:s', strtotime($existingValue)) : null;
            }

            if ($sourceValue !== $existingValue) {
                return true;
            }
        }

        return false;
    }

    /**
     * Create a new user from source data
     */
    private function createUser($sourceUser): void
    {
        $userData = $this->prepareUserData($sourceUser);
        User::create($userData);
    }

    /**
     * Update an existing user with source data
     */
    private function updateUser($sourceUser, $existingUser): void
    {
        $userData = $this->prepareUserData($sourceUser);
        $existingUser->update($userData);
    }

    /**
     * Prepare user data for create/update
     */
    private function prepareUserData($sourceUser): array
    {
        $fillableFields = (new User())->getFillable();
        $userData = [];

        // Copy all fillable fields that exist in source
        foreach ($fillableFields as $field) {
            if (property_exists($sourceUser, $field)) {
                $userData[$field] = $sourceUser->$field;
            }
        }

        // Handle password - if it exists in source, use it (assuming it's already hashed)
        // If not, set a default secure password that requires changing
        if (property_exists($sourceUser, 'password') && !empty($sourceUser->password)) {
            $userData['password'] = $sourceUser->password;
        } else {
            $userData['password'] = Hash::make('ChangeMe123!'); // Default password
        }

        // Handle email_verified_at
        if (property_exists($sourceUser, 'email_verified_at')) {
            $userData['email_verified_at'] = $sourceUser->email_verified_at;
        }

        // Handle remember_token
        if (property_exists($sourceUser, 'remember_token')) {
            $userData['remember_token'] = $sourceUser->remember_token;
        }

        // Handle timestamps
        if (property_exists($sourceUser, 'created_at')) {
            $userData['created_at'] = $sourceUser->created_at;
        }

        if (property_exists($sourceUser, 'updated_at')) {
            $userData['updated_at'] = $sourceUser->updated_at;
        }

        return $userData;
    }

    /**
     * Show detailed information about what would be synced
     */
    private function showDetails($toCreate, $toUpdate): void
    {
        if ($toCreate->count() > 0) {
            $this->info("\n--- Users to Create ---");
            foreach ($toCreate->take(5) as $user) {
                $this->line("ID: {$user->id}, Email: {$user->email}, Name: " . ($user->name ?? 'N/A'));
            }
            if ($toCreate->count() > 5) {
                $this->line("... and " . ($toCreate->count() - 5) . " more");
            }
        }

        if ($toUpdate->count() > 0) {
            $this->info("\n--- Users to Update ---");
            foreach ($toUpdate->take(5) as $userPair) {
                $user = $userPair['source'];
                $this->line("ID: {$user->id}, Email: {$user->email}, Name: " . ($user->name ?? 'N/A'));
            }
            if ($toUpdate->count() > 5) {
                $this->line("... and " . ($toUpdate->count() - 5) . " more");
            }
        }
    }
}
