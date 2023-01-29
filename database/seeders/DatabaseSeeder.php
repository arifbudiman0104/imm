<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\PostCategory;
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
        Post::factory(100)->create();
        Comment::factory(500)->create();
    }
}
