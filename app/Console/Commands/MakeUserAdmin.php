<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    protected $signature = 'user:make-admin {email}';
    protected $description = 'Make a user an administrator';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        $user->role = UserRole::ADMIN;
        $user->save();

        $this->info("User {$email} has been made an administrator.");
        return 0;
    }
}
