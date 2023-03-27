<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;

class CreateAdminCommand extends Command
{
    protected $signature = 'create:admin {--email= : The email address of the new admin.} {--password= : The password for the new admin.}';

    protected $description = 'Create a new admin user.';

    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');

        $admin = Admin::findByEmail($email);

        if ($admin) {
            $this->error('An admin user with that email address already exists!');
            return;
        }

        $admin = new Admin;
        $admin->email = $email;
        $admin->password = bcrypt($password);
        $admin->save();

        $this->info('Admin user created successfully!');
    }
}
