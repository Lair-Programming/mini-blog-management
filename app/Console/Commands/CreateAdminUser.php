<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Create an admin account for the blog';

    public function handle(): int
    {
        $name = $this->ask('Name');
        $email = $this->ask('Email');
        $password = $this->secret('Password (at least 8 characters)');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('That is not a valid email address.');
            return self::FAILURE;
        }

        if (strlen((string) $password) < 8) {
            $this->error('The password must be at least 8 characters.');
            return self::FAILURE;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('An account with that email already exists.');
            return self::FAILURE;
        }

        User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        $this->info('Admin account created.');

        return self::SUCCESS;
    }
}
