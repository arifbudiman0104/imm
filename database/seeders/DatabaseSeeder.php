<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\PostCategory;
use App\Models\System;
use Illuminate\Database\Seeder;
use Database\Factories\PostFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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
                'username' => 'arifbudimanarrosyid',
                'email' => 'arifbudimanarrosyid@admin.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'is_verified' => true,
            ]
        );
        PostCategory::create(
            [
                'title' => 'Uncategorized',
                'slug' => 'uncategorized',
                'description' => 'Uncategorized',
            ]
        );
        PostCategory::create(
            [
                'title' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Laravel',
            ]
        );
        PostCategory::create(
            [
                'title' => 'PHP',
                'slug' => 'php',
                'description' => 'PHP',
            ]
        );
        PostCategory::create(
            [
                'title' => 'JavaScript',
                'slug' => 'javascript',
                'description' => 'JavaScript',
            ]
        );
        User::factory(100)->create();
        Post::factory(500)->create();
        Comment::factory(700)->create();
        System::create(
            [
                'name' => 'Register',
                'description' => 'Enable this to allow user to register. Don\'t forget to disable this after you finish user registration.',
                'is_active' => true,
            ]
        );
    }
}
