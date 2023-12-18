<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\PoliticalParty;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $politicalPartyIds = PoliticalParty::pluck('id')->toArray();
        $genders = [
            'male',
            'female',
            'transgender',
            'non-binary',
            'other',
            'refused to answer'
        ];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'location' => $this->faker->city(),
            'hometown' => $this->faker->city(),
            'bio' => $this->faker->paragraph(),
            'handle' => $this->faker->userName(),
            'job_title' => $this->faker->jobTitle(),
            'primary_political_party_id' => $this->faker->randomElement($politicalPartyIds),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_verified' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'is_protected' => $this->faker->boolean(),
            'is_suspended' => $this->faker->boolean(),
            'is_banned' => $this->faker->boolean(),
            'is_deleted' => $this->faker->boolean(),
            'is_flagged' => $this->faker->boolean(),
            'gender' => $genders[array_rand($genders)],
            'date_of_birth' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'thumbnail_url' => $this->faker->imageUrl(),
            'cover_url' => $this->faker->imageUrl(),
            'primary_constituency_id' => $this->faker->numberBetween(1, 100),
            'is_decision_maker' => $this->faker->boolean(),
            'is_mayor' => $this->faker->boolean(),
            'is_mp' => $this->faker->boolean(),
            'is_governor' => $this->faker->boolean(),
            'is_senator' => $this->faker->boolean(),
            'is_president' => $this->faker->boolean(),
            'is_vip' => $this->faker->boolean(),
            'is_team_member' => $this->faker->boolean(),
            'is_team_leader' => $this->faker->boolean(),
            'is_team_admin' => $this->faker->boolean(),
            'is_team_owner' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'followers_count' => $this->faker->numberBetween(1, 100),
            'following_count' => $this->faker->numberBetween(1, 100),
            'posts_count' => $this->faker->numberBetween(1, 100),
            'comments_count' => $this->faker->numberBetween(1, 100),
            'likes_count' => $this->faker->numberBetween(1, 100),
            'dislikes_count' => $this->faker->numberBetween(1, 100),
            'shares_count' => $this->faker->numberBetween(1, 100),
            'flags_count' => $this->faker->numberBetween(1, 100),
            'views_count' => $this->faker->numberBetween(1, 100),
            'last_login_at' => $this->faker->dateTime(),
            'last_login_ip' => $this->faker->ipv4(),
            'last_login_device' => $this->faker->userAgent(),
            'last_login_location' => $this->faker->city(),
            'last_login_country' => $this->faker->country(),
            'last_login_region' => $this->faker->state(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
