<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TorrentSigners>
 */
class TorrentSignersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'torrent_id' => function () {
                return \App\Models\Torrent::all()->random()->id;
            },
            'signer_id' => function () {
                return \App\Models\User::all()->random()->id;
            },
            'weight' => $this->faker->randomFloat(0, 0, 999),
            'post_code_at_time' => $this->faker->postcode,
            'is_anonymous_to_decision_maker' => $this->faker->boolean,
            'is_anonymous_to_public' => $this->faker->boolean,
            'is_opted_in_to_contact_about_this_signature' => $this->faker->boolean,
            'reason_for_signing' => $this->faker->sentence(15),
        ];
    }
}
