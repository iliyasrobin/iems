<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all users and their admin status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all(['id', 'name', 'email', 'is_admin']);

        $this->info('All Users:');
        $this->table(['ID', 'Name', 'Email', 'Is Admin'], $users->toArray());

        $adminCount = $users->where('is_admin', true)->count();
        $this->info("Total admin users: {$adminCount}");

        if ($adminCount === 0) {
            $this->warn('No admin users found! The sidebar approve buttons will not be visible.');

            if ($users->count() > 0) {
                $firstUser = $users->first();
                $this->info("Making user '{$firstUser->name}' an admin...");
                $firstUser->update(['is_admin' => true]);
                $this->info("User '{$firstUser->name}' is now an admin!");
            }
        }
    }
}
