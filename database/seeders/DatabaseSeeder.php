<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'is_superadmin' => true,
                'is_verified' => true,
            ]
        );
        User::create(
            [
                'name' => 'Arif Budiman Arrosyid',
                'email' => 'arifbudimanarrosyid@admin.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'is_verified' => true,
            ]
        );
        // User::create(
        //     [
        //         'name' => 'User 1',
        //         'email' => 'user1@user.com',
        //         'password' => bcrypt('password'),
        //         'is_admin' => false,
        //         'is_verified' => false,
        //     ],
        // );
        // User::create(
        //     [
        //         'name' => 'User 2',
        //         'email' => 'user2@user.com',
        //         'password' => bcrypt('password'),
        //         'is_admin' => false,
        //         'is_verified' => true,
        //     ],
        // );
        User::factory(100)->create();


    }
}
