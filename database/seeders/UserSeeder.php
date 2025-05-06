<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => Str::uuid(),
            'name' => 'Super Admin',
            'email' => 'admin@karsa.id',
            'password' => Hash::make('q1w2e3r4'),
            'role' => 'sys_admin',
        ]);

        User::create([
            'id' => Str::uuid(),
            'name' => 'IT Staff',
            'email' => 'staff@karsa.id',
            'password' => Hash::make('q1w2e3r4'),
            'role' => 'staff',
        ]);

        User::create([
            'id' => Str::uuid(),
            'name' => 'Kepala Unit',
            'email' => 'kepala@karsa.id',
            'password' => Hash::make('q1w2e3r4'),
            'role' => 'kepala',
        ]);
    }
}
