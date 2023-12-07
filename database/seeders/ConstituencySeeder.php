<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Constituency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ConstituencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedFromGeoJson();
        $this->updateFromApi();
    }
    public function seedFromGeoJson()
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
    private function updateFromApi()
    {
        $client = new Client();
        $constituenciesInDb = Constituency::all();
        $errors = 0;
        $successes = 0;
    
        Log::channel('constituencySeeder')->info('Starting constituency update', ['count' => $constituenciesInDb->count()]);

        foreach ($constituenciesInDb as $constituencyInDb) {
            Log::channel('constituencySeeder')->info('Searching for constituency by name', ['name' => $constituencyInDb->name]);

            $response = $client->request('GET', 'https://members-api.parliament.uk/api/Location/Constituency/Search/', [
                'query' => [
                    'searchText' => $constituencyInDb->name
                ]
            ]);

            $constituencyData = json_decode($response->getBody()->getContents(), true);
            $constituency = $constituencyData['items'][0]['value'] ?? null;

            if ($constituency) {
                Log::channel('constituencySeeder')->info('Received response for constituency', ['name' => $constituencyInDb->name, 'response' => $constituency]);
                if ($constituencyInDb) {
                    Log::channel('constituencySeeder')->info('Mapping data for constituency', ['name' => $constituency['name'], 'data' => $constituency]);
        
                    $constituencyInDb->hop_id = $constituency['id'];
                    $constituencyInDb->start_date = $constituency['startDate'];
                    $constituencyInDb->end_date = $constituency['endDate'];
                    $constituencyInDb->hop_member_id = $constituency['currentRepresentation']['member']['value']['id'];
                    $constituencyInDb->incumbent_party = $constituency['currentRepresentation']['member']['value']['latestParty']['name'];
                    $constituencyInDb->save();

                    $successes++;
        
                    Log::channel('constituencySeeder')->info('Successfully saved constituency', ['name' => $constituency['name'], 'data' => $constituencyInDb]);
                }
                
            } else {
                $errors++;
                Log::channel('constituencySeeder')->warning('No constituency found for name', ['searchText' => $constituencyInDb->name, 'result' => $constituencyData ?? 'No results', 'response' => $response ?? 'No response']);
            }

        }

        Log::channel('constituencySeeder')->info('Finished constituency update', ['errors' => $errors, 'successes' => $successes]);

    }
}