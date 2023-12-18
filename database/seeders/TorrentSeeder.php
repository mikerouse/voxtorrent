<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Torrent;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TorrentSigners;
use App\Models\Hashtag;
use App\Models\DecisionMakers;
use Illuminate\Support\Arr;

class TorrentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        // create torrents
        Torrent::factory(50)->create()->each(function ($torrent) {
            // create 100 hashtags
            $hashtags = Hashtag::factory(100)->create();
            // Get the IDs of all hashtags
            $hashtagIds = $hashtags->pluck('id')->toArray();
            // Add the IDs of the favored hashtags multiple times to introduce a bias
            $hashtagIds = array_merge($hashtagIds, array_fill(0, 10, 1), array_fill(0, 10, 2));

            $signaturesCount = rand(2, 200);
            for ($i = 0; $i < $signaturesCount; $i += 100) {
                $count = min(25, $signaturesCount - $i);

                // Add signatures
                $torrent->signatures()->createMany(
                    TorrentSigners::factory()->count($count)->make()->toArray()
                );

                // Add decision makers
                $decisionMakers = DecisionMakers::inRandomOrder()->take(rand(1, 8))->pluck('id');
                $torrent->decision_makers()->attach($decisionMakers);

                // we want some hashtags to be more popular than others, so we'll add the same hashtags multiple times
                $hashtagsPlucked = Arr::random($hashtagIds, rand(1, 8));
                $torrent->hashtags()->attach($hashtagsPlucked);

            }
        });
    }
}
