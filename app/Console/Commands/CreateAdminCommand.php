<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateAdminCommand extends Command
{

    protected $signature = 'create:admin
                            {--name= : The name of the new admin user (required)}
                            {--email= : The email of the new admin user (required)}
                            {--password= : The password of the new admin user (required)}';
    protected $description = 'Create a new admin user';
    public function handle()
    {
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');

        // Check if a user with the given email already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            $this->error('A user with this email already exists.');
            return 1;
        }

        $user = User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $user->assignRole('admin');
        $this->info('Admin user created successfully.');
        return 0;
    }
}
