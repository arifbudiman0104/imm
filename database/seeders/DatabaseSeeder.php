<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Organization;
use App\Models\OrganizationHistory;
use App\Models\OrganizationPosition;
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
                'instagram' => 'https://www.instagram.com/arifbudimanarrosyid/',
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
        Post::factory(1000)->create();
        Comment::factory(2000)->create();
        System::create(
            [
                'name' => 'Register',
                'description' => 'Enable this to allow user to register. Don\'t forget to disable this after you finish user registration.',
                'is_active' => true,
            ]
        );

        Organization::create(
            [
                'name' => 'Pimpinan Cabang IMM Banyumas',
                'description' => 'IMM Banyumas',
            ]
        );
        Organization::create(
            [
                'name' => 'Pimpinan Komisariat IMM Insan Kamil',
                'description' => 'IMM Insan Kamil',
            ]
        );

        OrganizationPosition::create(
            [
                'name' => 'Ketua',
            ]
        );

        OrganizationPosition::create(
            [
                'name' => 'Wakil Ketua',
            ]
        );

        OrganizationHistory::create(
            [
                'user_id' => 2,
                'organization_id' => 2,
                'organization_position_id' => 1,
                'start_year' => 2021,
                'end_year' => 2022,
            ]
        );
        OrganizationHistory::factory(100)->create();

    }
}
