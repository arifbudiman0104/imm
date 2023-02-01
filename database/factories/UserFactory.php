<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'hide_email' => rand(0, 1),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin' => false,
            'is_verified' => rand(0, 1),
            'gender'=> rand(0, 1) ? 'male' : 'female',
            'pob' => fake()->city(),
            'dob' => fake()->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'sid' => fake()->unique()->numberBetween(1000000000, 9999999999),
            'university' => fake()->company(),
            'faculty' => fake()-> jobTitle(),
            'program_study' => fake()->jobTitle(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'bio' => fake()->text(),
            'instagram' => fake()->url(),
            'facebook' => fake()->url(),
            'twitter' => fake()->url(),
            'youtube' => fake()->url(),
            'website' => fake()->url(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
