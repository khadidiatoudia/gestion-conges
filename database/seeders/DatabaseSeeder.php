<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@univ.com',
        ], [
            'name' => 'Admin Universite',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::updateOrCreate([
            'email' => 'gestionnaire@univ.com',
        ], [
            'name' => 'Gestionnaire RH',
            'password' => Hash::make('password'),
            'role' => User::ROLE_GESTIONNAIRE,
        ]);

        $this->call(JoursFeriesSenegalSeeder::class);
    }
}
