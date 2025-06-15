<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Panggil seeder untuk membuat role terlebih dahulu
        // $this->call(RoleSeeder::class);

        // 2. Panggil seeder untuk membuat kategori
        $this->call(CategorySeeder::class);

    //     // 3. Buat user admin
    //     $admin = User::create([
    //         'name' => 'Admin User',
    //         'email' => 'admin@example.com',
    //         'password' => Hash::make('password'), // Ganti dengan password yang aman
    //     ]);
    //     $admin->assignRole('Admin'); // <-- Memberikan role 'Admin'

    //     // 4. Buat user editor
    //     $editor = User::create([
    //         'name' => 'Editor User',
    //         'email' => 'editor@example.com',
    //         'password' => Hash::make('password'),
    //     ]);
    //     $editor->assignRole('Editor'); // <-- Memberikan role 'Editor'

    //     // 5. Buat user wartawan
    //     $wartawan = User::create([
    //         'name' => 'Wartawan User',
    //         'email' => 'wartawan@example.com',
    //         'password' => Hash::make('password'),
    //     ]);
    //     $wartawan->assignRole('Wartawan'); // <-- Memberikan role 'Wartawan'
    }
}