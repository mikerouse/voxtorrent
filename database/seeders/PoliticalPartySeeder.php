<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliticalPartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Let's create the Conseravtive Party
        $conservativeParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Conservative Party',
            'abbreviation' => 'CON',
            'slug' => 'conservative-party',
            'description' => 'The Conservative Party, officially the Conservative and Unionist Party, and also known colloquially as the Tories or simply the Conservatives, is a political party in the United Kingdom. Ideologically, the Conservatives sit on the centre-right of the political spectrum.',
            'wikipedia_url' => 'https://en.wikipedia.org/wiki/Conservative_Party_(UK)',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/b/b6/Conservative_logo_2006.svg/1200px-Conservative_logo_2006.svg.png',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#0087DC',
            'brand_color_rgb' => '0, 135, 220',
            'brand_color_rgba' => '0, 135, 220, 1',
        ]);

        // Let's create the Labour Party
        $labourParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Labour Party',
            'abbreviation' => 'LAB',
            'slug' => 'labour-party',
            'description' => '',
            'wikipedia_url' => 'https://en.wikipedia.org/wiki/Labour_Party_(UK)',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/0/0a/Logo_of_the_British_Labour_Party.svg/1200px-Logo_of_the_British_Labour_Party.svg.png',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#DC241f',
            'brand_color_rgb' => '220, 36, 31',
            'brand_color_rgba' => '220, 36, 31, 1',
        ]);

        $liberalDemocratParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Liberal Democrats',
            'abbreviation' => 'LD',
            'slug' => 'liberal-democrats',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#FDBB30',
            'brand_color_rgb' => '253, 187, 48',
            'brand_color_rgba' => '253, 187, 48, 1',
        ]);

        $reformUK = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Reform UK',
            'abbreviation' => 'REF',
            'slug' => 'reform-uk',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#FDBB30',
            'brand_color_rgb' => '253, 187, 48',
            'brand_color_rgba' => '253, 187, 48, 1',
        ]);

        $greenParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Green Party',
            'abbreviation' => 'GRN',
            'slug' => 'green-party',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#6AB023',
            'brand_color_rgb' => '106, 176, 35',
            'brand_color_rgba' => '106, 176, 35, 1',
        ]);

        $scottishNationalParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Scottish National Party',
            'abbreviation' => 'SNP',
            'slug' => 'scottish-national-party',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#FFF95D',
            'brand_color_rgb' => '255, 249, 93',
            'brand_color_rgba' => '255, 249, 93, 1',
        ]);

        $plaidCymru = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Plaid Cymru',
            'abbreviation' => 'PC',
            'slug' => 'plaid-cymru',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

        $allianceParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Alliance Party',
            'abbreviation' => 'APNI',
            'slug' => 'alliance-party',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#F6CB2F',
            'brand_color_rgb' => '246, 203, 47',
            'brand_color_rgba' => '246, 203, 47, 1',
        ]);

        $sinnFein = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Sinn Féin',
            'abbreviation' => 'SF',
            'slug' => 'sinn-fein',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

        $socialDemocraticAndLabourParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Social Democratic and Labour Party',
            'abbreviation' => 'SDLP',
            'slug' => 'social-democratic-and-labour-party',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

        $ulsterUnionistParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Ulster Unionist Party',
            'abbreviation' => 'UUP',
            'slug' => 'ulster-unionist-party',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

        $democraticUnionistParty = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Democratic Unionist Party',
            'abbreviation' => 'DUP',
            'slug' => 'democratic-unionist-party',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => true,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

        $other = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Other',
            'abbreviation' => 'OTH',
            'slug' => 'other',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => false,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

        $independent = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Independent',
            'abbreviation' => 'IND',
            'slug' => 'independent',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => false,
            'is_featured' => false,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

        $speaker = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Speaker of the House',
            'abbreviation' => 'SPE',
            'slug' => 'speaker-of-the-house',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => true,
            'is_featured' => false,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

        $vacant = \App\Models\PoliticalParty::factory()->create([
            'name' => 'Vacant',
            'abbreviation' => 'VAC',
            'slug' => 'vacant',
            'description' => '',
            'wikipedia_url' => '',
            'logo_url' => '',
            'is_blocked' => false,
            'is_trash' => true,
            'is_featured' => false,
            'brand_color_hex' => '#008142',
            'brand_color_rgb' => '0, 129, 66',
            'brand_color_rgba' => '0, 129, 66, 1',
        ]);

    }
}
