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
                return \Illuminate\Support\Str::limit(\Illuminate\Support\Str::slug($attributes['name']), 60) . '-' . \Illuminate\Support\Str::random(10);
            },
            'description' => $this->faker->sentence(100),
            'qr_code' => $this->faker->randomAscii,
            'info_hash' => $this->faker->randomKey,
            'owner_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'weight' => $this->faker->randomFloat(0, 0, 99999),
            'views' => $this->faker->randomNumber(),
            'likes' => $this->faker->randomNumber(),
            'shares' => $this->faker->randomNumber(),
            'dislikes' => $this->faker->randomNumber(),
            'flags' => $this->faker->randomNumber(),
            'is_blocked' => $this->faker->boolean,
            'is_sensitive' => $this->faker->boolean,
            'is_trash' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'avg_dwell_time_secs' => $this->faker->randomFloat(0, 0, 99),
        ];
    }
}
