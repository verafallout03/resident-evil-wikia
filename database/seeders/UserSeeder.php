<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'              => 'Admin Principal',
                'email'             => 'admin@residentevil.wiki',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'avatar'            => null,
                'bio'               => 'Administrador principal de la wiki.',
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Editor Staff',
                'email'             => 'editor@residentevil.wiki',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'role'              => 'editor',
                'avatar'            => null,
                'bio'               => 'Editor de contenido y enciclopedia.',
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Guest User',
                'email'             => 'guest@example.com',
                'email_verified_at' => null,
                'password'          => Hash::make('password'),
                'role'              => 'guest',
                'avatar'            => null,
                'bio'               => null,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Hiram Rodriguez Vera',
                'email'             => 'rodriguezverahiram3@gmail.com',
                'email_verified_at' => null,
                'password'          => Hash::make('hiram'),
                'role'              => 'admin',
                'avatar'            => null,
                'bio'               => null,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
