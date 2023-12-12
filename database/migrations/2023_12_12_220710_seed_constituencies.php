<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Database\Seeders\ConstituencyTypeSeeder;
use Database\Seeders\ConstituencySeeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\DB;
use App\Models\Constituency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $constituencyTypes = [
            [
                'name' => 'UK Parliamentary Constituency',
                'acronym' => 'UKHOC',
            ],
            [
                'name' => 'County Council',
                'acronym' => 'CC',
            ],
            [
                'name' => 'County Council Division',
                'acronym' => 'CCD',
            ],
            [
                'name' => 'District Council',
                'acronym' => 'DC',
            ],
            [
                'name' => 'District Council Ward',
                'acronym' => 'DCW',
            ],
            [
                'name' => 'London Assembly Constituency',
                'acronym' => 'LAC',
            ],
            [
                'name' => 'Parish Council',
                'acronym' => 'PC',
            ],
            [
                'name' => 'Parish Council Ward',
                'acronym' => 'PCW',
            ],
            [   
                'name' => 'Scottish Parliament Constituency',
                'acronym' => 'SPC',
            ],
            [   
                'name' => 'Scottish Parliament Region',
                'acronym' => 'SPR',
            ],
            [   
                'name' => 'Unitary Authority',
                'acronym' => 'UA',
            ],
            [   
                'name' => 'Unitary Authority Division',
                'acronym' => 'UAD',
            ],
            [   
                'name' => 'Welsh Assembly Constituency',
                'acronym' => 'WAC',
            ],
            [   
                'name' => 'Welsh Assembly Region',
                'acronym' => 'WAR',
            ],
            [
                'name' => 'European Parliament Constituency',
                'acronym' => 'EPC',
            ],
            [   
                'name' => 'Police & Crime Commissioner',
                'acronym' => 'PCC',
            ],
            [
                'name' => 'Mayor',
                'acronym' => 'MAY',
            ],
            [
                'name' => 'London Borough Council',
                'acronym' => 'LBC',
            ],
            [
                'name' => 'London Borough Council Ward',    
                'acronym' => 'LBCW',
            ],
            [   
                'name' => 'Greater London Authority',
                'acronym' => 'GLA',
            ],
            [   
                'name' => 'Greater London Authority Constituency',
                'acronym' => 'GLAC',
            ],
            [   
                'name' => 'Greater London Authority Region',
                'acronym' => 'GLAR',
            ],
            [
                'name' => 'Combined Authority',
                'acronym' => 'CA',
            ],
            [   
                'name' => 'Combined Authority Constituency',
                'acronym' => 'CAC',
            ],
            [
                'name' => 'Combined Authority Region',
                'acronym' => 'CAR',
            ],
            [
                'name' => 'Combined Authority Mayoralty',
                'acronym' => 'CAM',
            ],
            [
                'name' => 'Student Union',
                'acronym' => 'SU',
            ],
            [
                'name' => 'Student Union Constituency',
                'acronym' => 'SUC',
            ],
            [
                'name' => 'School Council',
                'acronym' => 'SC',
            ],
            [
                'name' => 'UK Youth Parliament',
                'acronym' => 'UKYP',
            ],
            [
                'name' => 'UK Youth Parliament Constituency',
                'acronym' => 'UKYPC',
            ],
            [
                'name' => 'Political Party',
                'acronym' => 'PP',
            ],
            [
                'name' => 'Political Party Region',
                'acronym' => 'PPR',
            ],
            [
                'name' => 'Political Party Constituency',
                'acronym' => 'PPC',
            ],
            [
                'name' => 'Political Party Branch', 
                'acronym' => 'PPB',
            ],
            [
                'name' => 'Political Party Area',
                'acronym' => 'PPA',
            ],
            [
                'name' => 'Private Membership Club',
                'acronym' => 'PMC',
            ],
            [
                'name' => 'Private Company',
                'acronym' => 'PCO',
            ],
            [  
                'name' => 'Charity',
                'acronym' => 'CHA',
            ],
            [
                'name' => 'Trade Union',
                'acronym' => 'TU',
            ],
            [
                'name' => 'Trade Union Branch',
                'acronym' => 'TUB',
            ],
            [
                'name' => 'School Governing Body',
                'acronym' => 'SGB',
            ],
            [
                'name' => 'Newspaper Coverage Area',
                'acronym' => 'NCA',
            ],
            [
                'name' => 'Newspaper Readership',
                'acronym' => 'NR',
            ],
            [
                'name' => 'Media Outlet',
                'acronym' => 'MO',
            ],
            [
                'name' => 'Public Body',
                'acronym' => 'PB',
            ],
            [
                'name' => 'Government Department',
                'acronym' => 'GD',
            ],
            [
                'name' => 'Government Agency',
                'acronym' => 'GA',
            ],
            [
                'name' => 'Government Quango',
                'acronym' => 'GQ',
            ],
            [
                'name' => 'Website',
                'acronym' => 'WEB',
            ],
            [
                'name' => 'Social Media Platform',
                'acronym' => 'SMP',
            ],
            [
                'name' => 'Smartphone App',
                'acronym' => 'SA',
            ],
            [
                'name' => 'Political Party Group',
                'acronym' => 'PPG',
            ],
            [
                'name' => 'Training',
                'acronym' => 'TRAIN',
            ],
            [
                'name' => 'Testing',
                'acronym' => 'TEST',
            ]
        ];

        foreach ($constituencyTypes as $constituencyType) {
            \App\Models\ConstituencyType::create($constituencyType);
        }

        $this->seedFromGeoJson();
        $this->updateFromApi();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
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

            $constituencyData = Cache::remember('constituency_' . $constituencyInDb->name, 60*96, function () use ($client, $constituencyInDb) {
                $response = $client->request('GET', 'https://members-api.parliament.uk/api/Location/Constituency/Search/', [
                    'query' => [
                        'searchText' => $constituencyInDb->name
                    ]
                ]);
        
                return json_decode($response->getBody()->getContents(), true);
            });
        
            $constituency = $constituencyData['items'][0]['value'] ?? null;

            if ($constituency) {
                Log::channel('constituencySeeder')->info('Received response for constituency', ['name' => $constituencyInDb->name, 'response' => $constituency]);
                if ($constituencyInDb) {
                    Log::channel('constituencySeeder')->info('Mapping data for constituency', ['name' => $constituency['name'], 'data' => $constituency]);
        
                    $constituencyInDb->hop_id = $constituency['id'];
                    $constituencyInDb->start_date = $constituency['startDate'];
                    $constituencyInDb->end_date = $constituency['endDate'];
                    $constituencyInDb->current_hop_member_id = $constituency['currentRepresentation']['member']['value']['id'];
                    $constituencyInDb->incumbent_party = $constituency['currentRepresentation']['member']['value']['latestParty']['name'];
                    $constituencyInDb->save();

                    $successes++;
        
                    Log::channel('constituencySeeder')->info('Successfully saved constituency', ['name' => $constituency['name'], 'data' => $constituencyInDb]);
                }
                
            } else {
                $errors++;
                Log::channel('constituencySeeder')->warning('No constituency found for name', ['searchText' => $constituencyInDb->name, 'result' => $constituencyData ?? 'No results', 'errors' => $errors]);
            }

        }

        Log::channel('constituencySeeder')->info('Finished constituency update', ['errors' => $errors, 'successes' => $successes]);

    }
};
