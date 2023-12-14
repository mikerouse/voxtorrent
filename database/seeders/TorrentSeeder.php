<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Torrent;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TorrentSigners;
use App\Models\Hashtags;
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
            $signaturesCount = rand(12, 500);
            for ($i = 0; $i < $signaturesCount; $i += 100) {
                $count = min(100, $signaturesCount - $i);
                $torrent->signatures()->createMany(
                    TorrentSigners::factory()->count($count)->make()->toArray()
                );
                $torrent->hashtags()->attach(
                    Hashtags::factory()->count(rand(1, 5))->create()
                );

                // Add decision makers
                $decisionMakers = DecisionMakers::inRandomOrder()->take(rand(1, 5))->pluck('id');
                $torrent->decision_makers()->attach($decisionMakers);

                // Add hashtags
                $torrent->hashtags()->attach(
                    Hashtags::factory()->count(rand(1, 5))->create()
                );

            }
        });
    }
}
