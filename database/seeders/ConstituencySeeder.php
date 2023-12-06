<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstituencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $geoJsonData = file_get_contents(database_path('seeds/westminster.geojson'));
        $constituencies = json_decode($geoJsonData, true)['features'];

        foreach ($constituencies as $constituency) {

            // Get the first letter of the PCON22CD property
            $nation_letter = substr($constituency['properties']['PCON22CD'], 0, 1);

            // If the nation's letter is E, W, or S, then it's England, Wales, or Scotland. N is Northern Ireland.
            switch ($nation_letter) {
                case 'E':
                    $nation = 'England';
                    break;
                case 'W':
                    $nation = 'Wales';
                    break;
                case 'S':
                    $nation = 'Scotland';
                    break;
                case 'N':
                    $nation = 'Northern Ireland';
                    break;
                default:
                    $nation = 'Unknown';
            }

            // Each constituency is of the 'UK Parliamentary Constituency' type
            $constituency_type_id = DB::table('constituency_types')
                ->where('acronym', 'UKHOC')
                ->first()
                ->id;

            DB::table('constituencies')->insert([
                'ons_id' => $constituency['properties']['PCON22CD'],
                'name' => $constituency['properties']['PCON22NM'],
                'nation' => $nation,
                'population' => 0,
                'incumbent_party' => 'unknown',
                'constituency_type_id' => $constituency_type_id,
            ]);
        }
    }
}