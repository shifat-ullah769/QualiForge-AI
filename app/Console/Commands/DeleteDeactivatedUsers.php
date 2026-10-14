<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteDeactivatedUsers extends Command
{
    protected $signature = 'users:delete-deactivated';

    protected $description = 'Delete users whose accounts have been deactivated for 30 days or more';

    public function handle(): int
    {
        $users = User::where('is_active', false)
            ->whereNotNull('deactivated_at')
            ->where('deactivated_at', '<=', now()->subDays(30))
            ->get();

        foreach ($users as $user) {
            $user->delete();
        }

        $this->info("Deleted {$users->count()} deactivated user(s).");

        return self::SUCCESS;
    }
}