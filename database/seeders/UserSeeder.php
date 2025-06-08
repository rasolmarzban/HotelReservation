<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => UserRole::ADMIN->value,
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Regular user
        DB::table('users')->insert([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => Hash::make('customerpassword'),
            'role' => UserRole::USER->value,
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Another regular user
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('johnpassword'),
            'role' => UserRole::USER->value,
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Another Admin user (Optional for testing purposes)
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadminpassword'),
            'role' => UserRole::ADMIN->value,
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
