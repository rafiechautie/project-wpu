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
    public function definition(): array
    {
        return [
            //mt_rand untuk memberikan data random minimal 1 dan maksimal 2
            'category_id' => mt_rand(1, 3),
            'user_id' => mt_rand(1, 6),
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            // 'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(5, 10))) . '</p>'
            // 'body' => $this->faker->paragraphs(mt_rand(5, 10))
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($p) => "<p>$p</p>")->implode('')
        ];
    }
}
