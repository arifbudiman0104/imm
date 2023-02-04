<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'post_category_id' => rand(1, 7),
            'title' => $this->faker->sentence(mt_rand(3, 10)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(mt_rand(1, 2)),
            // 'content' => '<p>'.implode ('<p></p>',  $this->faker->paragraphs(mt_rand(10, 13))).'</p>',
            'body' => collect($this->faker->paragraphs(mt_rand(10, 15)))
                ->map(fn ($p) => "<p>$p</p>")
                ->implode(''),
            'is_published' => rand(0, 1),
            'is_featured' => rand(0, 1),
            'is_approved' => rand(0, 1),
            'is_requested' => rand(0, 1),
            'is_rejected' => rand(0, 1),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'approved_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'views' => rand(0, 1000),
        ];
    }
}
