<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Organization;
use App\Models\OrganizationField;
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
                'email_verified_at' => now(),
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
                'email_verified_at' => now(),
                'pob' => 'Banyumas',
                // 'dob'=> '01-04-1996',
                'dob' => '1996-04-01',
                'gender' => 'male',
                'phone' => '081234567890',
                'address' => 'Jl. Raya Banyumas No. 1',
                'sid' => '20180140119',
                'university' => 'Universitas Muhammadiyah Yogyakarta',
                'faculty' => 'Falakultas Teknik',
                'program_study' => 'Teknik Informatika',
                'bio' => 'I am web developer of IMM Banyumas',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'is_verified' => true,
                'instagram' => 'https://www.instagram.com/arifbudimanarrosyid/',
                'facebook' => 'https://www.instagram.com/arifbudimanarrosyid/',
            ]
        );
        User::create(
            [
                'name' => 'Arif',
                'username' => 'arif',
                'email' => 'arif@admin.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'is_verified' => true,
                'bio' => 'Ini Bio',
                'instagram' => 'https://www.instagram.com/arif/',
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
        PostCategory::create(
            [
                'title' => 'Windows',
                'slug' => 'Windows',
                'description' => 'Windows',
            ]
        );
        PostCategory::create(
            [
                'title' => 'Linux',
                'slug' => 'linux',
                'description' => 'Linux',
            ]
        );
        PostCategory::create(
            [
                'title' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Web Development',
            ]
        );
        System::create(
            [
                'name' => 'Register',
                'description' => 'Enable this to allow user to register. Don\'t forget to disable this after you finish user registration.',
                'is_active' => true,
            ]
        );
        Organization::create(
            [
                'name' => 'PC IMM Banyumas',
                'description' => 'IMM Banyumas',
            ]
        );
        Organization::create(
            [
                'name' => 'PK IMM Insan Kamil',
                'description' => 'IMM Insan Kamil',
            ]
        );
        Organization::create(
            [
                'name' => 'PK IMM Teknik',
                'description' => 'IMM Teknik',
            ]
        );
        Organization::create(
            [
                'name' => 'PK IMM FAI',
                'description' => 'IMM Teknik',
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
        OrganizationField::create(
            [
                'name' => 'Bidang Kaderisasi',
            ]
        );
        OrganizationField::create(
            [
                'name' => 'Bidang Media dan Publikasi',
            ]
        );
        OrganizationHistory::create(
            [
                'user_id' => 2,
                'organization_id' => 1,
                'organization_position_id' => 2,
                'organization_field_id' => 1,
                'start_year' => 2021,
                'end_year' => 2022,
                'is_active' => true,
                'is_approved' => true,
            ]
        );

        OrganizationHistory::create(
            [
                'user_id' => 2,
                'organization_id' => 2,
                'organization_position_id' => 1,
                'organization_field_id' => 2,
                'start_year' => 2021,
                'end_year' => 2022,
                'is_active' => false,
                'is_approved' => true,
            ]
        );

        OrganizationHistory::create(
            [
                'user_id' => 3,
                'organization_id' => 1,
                'organization_position_id' => 2,
                'organization_field_id' => 2,
                'start_year' => 2021,
                'end_year' => 2022,
                'is_active' => true,
                'is_approved' => true,
            ]
        );
        User::factory(100)->create();
        Post::factory(1000)->create();
        Comment::factory(2000)->create();
        OrganizationHistory::factory(100)->create();
    }
}
