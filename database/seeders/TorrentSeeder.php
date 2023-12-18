<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Torrent;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TorrentSigners;
use App\Models\Hashtag;
use App\Models\DecisionMakers;

class TorrentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        Torrent::factory(50)->create()->each(function ($torrent) {
            $signaturesCount = rand(12, 250);
            for ($i = 0; $i < $signaturesCount; $i += 100) {
                $count = min(100, $signaturesCount - $i);

                // Add signatures
                $torrent->signatures()->createMany(
                    TorrentSigners::factory()->count($count)->make()->toArray()
                );

                // Add decision makers
                $decisionMakers = DecisionMakers::inRandomOrder()->take(rand(1, 8))->pluck('id');
                $torrent->decision_makers()->attach($decisionMakers);

                // Add hashtags
                $torrent->hashtags()->attach(
                    Hashtag::factory()->count(rand(1, 8))->create()
                );

            }
        });
    }
}
