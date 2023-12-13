<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hashtags>
 */
class HashtagsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => function (array $attributes) {
                return \Illuminate\Support\Str::limit(\Illuminate\Support\Str::slug($attributes['name']), 50);
            },
            'description' => $this->faker->sentence(100),
            'creator_id' => function () {
                return \App\Models\User::all()->random()->id;
            },
            'weight' => $this->faker->randomFloat(0, 0, 99),
            'views' => $this->faker->randomFloat(0, 0, 99),
            'likes' => $this->faker->randomFloat(0, 0, 99),
            'shares' => $this->faker->randomFloat(0, 0, 99),
            'dislikes' => $this->faker->randomFloat(0, 0, 99),
            'flags' => $this->faker->randomFloat(0, 0, 99),
            'is_blocked' => $this->faker->boolean,
            'is_sensitive' => $this->faker->boolean,
            'is_trash' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
        ];
    }
}
