<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationHistory>
 */
class OrganizationHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 100),
            'organization_id' => rand(1, 2),
            'organization_position_id' => rand(1, 2),
            'start_year' => $this->faker->year,
            'end_year' => $this->faker->year,
            'is_active' => 1,
            'is_requested' => 1,
            'is_approved' => 1,
        ];
    }
}
