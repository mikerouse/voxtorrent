<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Torrent;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TorrentSigners;

class TorrentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        Torrent::factory(30)->create()->each(function ($torrent) {
            $signaturesCount = rand(12, 3000); // A few dozen to a few thousand
            for ($i = 0; $i < $signaturesCount; $i += 100) {
                $count = min(100, $signaturesCount - $i);
                $torrent->signatures()->createMany(
                    TorrentSigners::factory()->count($count)->make()->toArray()
                );
            }
        });
    }
}
