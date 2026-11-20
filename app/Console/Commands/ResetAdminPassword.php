<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password';

    protected $description = 'Set a new password for an existing admin account';

    public function handle(): int
    {
        $emails = User::pluck('email');

        if ($emails->isEmpty()) {
            $this->error('No accounts exist yet. Run admin:create first.');
            return self::FAILURE;
        }

        // Show the existing emails, so you can see exactly which one to use.
        $this->info('Existing accounts: ' . $emails->implode(', '));

        $email = $this->ask('Email of the account to reset');
        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error('No account found with that email.');
            return self::FAILURE;
        }

        $password = $this->secret('New password (at least 8 characters)');
        $confirm = $this->secret('Type the new password again');

        if (strlen((string) $password) < 8) {
            $this->error('The password must be at least 8 characters.');
            return self::FAILURE;
        }

        if ($password !== $confirm) {
            $this->error('The two passwords do not match. Nothing was changed.');
            return self::FAILURE;
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->info('Password updated.');

        return self::SUCCESS;
    }
}
