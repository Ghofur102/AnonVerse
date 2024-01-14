<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'username' => 'Admin',
            'password' => Hash::make('admin123'),
            'bio' => 'Saya adalah admin website AnonVerse!',
            'role' => 'admin'
        ]);
        // user
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'username' => 'Galang',
            'password' => Hash::make('galang123'),
            'bio' => 'Saya adalah user website AnonVerse!',
            'role' => 'user'
        ]);
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'username' => 'Ghofur',
            'password' => Hash::make('ghofur123'),
            'bio' => 'Saya adalah user website AnonVerse!',
            'role' => 'user'
        ]);
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'username' => 'Reyhan',
            'password' => Hash::make('reyhan123'),
            'bio' => 'Saya adalah user website AnonVerse!',
            'role' => 'user'
        ]);
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'username' => 'Hafidz',
            'password' => Hash::make('hafidz123'),
            'bio' => 'Saya adalah user website AnonVerse!',
            'role' => 'user'
        ]);
    }
}
