<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Constituency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\DecisionMakers;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->updateFromApi();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    public function updateFromApi(): void
    {
        // Get the list of constituencies
        $constituencies = Constituency::all();

        Log::channel('decisionMakersSeeder')->info('Starting MP seeding for ' . $constituencies->count() . ' constituencies');

        // For each constituency, get the MP's ID from the API
        foreach ($constituencies as $constituency) {
            Log::channel('decisionMakersSeeder')->info('Updating MP for ' . $constituency->name);
            if ($constituency->current_hop_member_id !== null && $constituency->current_hop_member_id !== 0) {
                // Log::info('Member ID found for ' . $constituency->name . ', ' . $constituency->current_hop_member_id);
                $apiRequestUrl = 'https://members-api.parliament.uk/api/Members/' . $constituency->current_hop_member_id;
                // Log::info('API request URL ' . $apiRequestUrl);
                $this->updateDecisionMakersFromApi($constituency, $apiRequestUrl); // Call the updateDecisionMakersFromApi method
            } else {
                Log::channel('decisionMakersSeeder')->error('No member ID to use with the API found for ' . $constituency->name);
            }
        }
    }

    public function updateDecisionMakersFromApi($constituency, $apiRequestUrl): void
    {
        $client = new Client();

        $responseBody = Cache::remember('api_response_' . md5($apiRequestUrl), 60*48, function () use ($client, $apiRequestUrl) {
            $response = $client->request('GET', $apiRequestUrl);
            return json_decode($response->getBody(), true);
        });
    
        Log::channel('decisionMakersSeeder')->info('API Response ', ['requestUrl' => $apiRequestUrl, 'responseBody' => json_encode($responseBody)]);
    
        $member = $responseBody['value'];
        if (isset($member)) {
            $decisionMaker = DecisionMakers::firstOrNew(
                ['hop_member_id' => $member['id']]
            );
            if ($decisionMaker->exists) {
                Log::channel('decisionMakersSeeder')->info('Decision maker already exists: ', ['name' => $decisionMaker->display_name, 'hop_member_id' => $decisionMaker->hop_member_id, 'constituency' => $constituency->name]);
            }
            $decisionMaker->display_name = $member['nameFullTitle'];
            $decisionMaker->gender = $member['gender'];
            $decisionMaker->thumbnail_url = $member['thumbnailUrl'];
            $decisionMaker->current_party = $member['latestParty']['name'];
            $decisionMaker->save();
            $constituency->decision_makers()->syncWithoutDetaching($decisionMaker->id);

            // Now allocate the decision maker to their party based on abbreviation
            $apiAbbreviation = strtoupper($member['latestParty']['abbreviation']);
            $decisionMaker->political_party_id = $this->getPoliticalPartyIdFromAbbreviation($apiAbbreviation);

            Log::channel('decisionMakersSeeder')->info('MP saved: ', ['name' => $decisionMaker->display_name, 'hop_member_id' => $decisionMaker->hop_member_id, 'constituency' => $constituency->name, 'political_party_id' => $decisionMaker->political_party_id]);
        } else {
            Log::channel('decisionMakersSeeder')->error('Decision maker not found for ' . $constituency->name);
        }
    }

    /** 
     * Get a political party by its abbreviation! 
    */
    public function getPoliticalPartyIdFromAbbreviation($abbreviation)
    {
        $politicalParty = \App\Models\PoliticalParty::where('abbreviation', $abbreviation)->first();
        if ($politicalParty) {
            return $politicalParty->id;
        } else {
            return 0;
        }
    }
};
