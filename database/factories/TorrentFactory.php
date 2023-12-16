<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Torrent>
 */
class TorrentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(10),
            'slug' => function (array $attributes) {
                return \Illuminate\Support\Str::limit(\Illuminate\Support\Str::slug($attributes['name']), 50) . '-' . \Illuminate\Support\Str::random(5);
            },
            'description' => $this->faker->paragraphs(3, true),
            'qr_code' => $this->faker->randomKey,
            'info_hash' => $this->faker->randomKey,
            'owner_id' => function () {
                return \App\Models\User::all()->random()->id;
            },
            'weight' => $this->faker->randomFloat(0, 0, 999),
            'views' => $this->faker->randomFloat(0, 0, 999),
            'likes' => $this->faker->randomFloat(0, 0, 999),
            'shares' => $this->faker->randomFloat(0, 0, 999),
            'dislikes' => $this->faker->randomFloat(0, 0, 999),
            'flags' => $this->faker->randomFloat(0, 0, 999),
            'is_blocked' => $this->faker->boolean,
            'is_sensitive' => $this->faker->boolean,
            'is_trash' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'avg_dwell_time_secs' => $this->faker->randomFloat(0, 0, 99),
        ];
    }
}
