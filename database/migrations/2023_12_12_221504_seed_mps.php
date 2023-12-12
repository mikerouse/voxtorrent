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

        // For each constituency, get the MP's ID from the API
        foreach ($constituencies as $constituency) {
            Log::info('Updating MP for ' . $constituency->name);
            if ($constituency->current_hop_member_id !== null && $constituency->current_hop_member_id !== 0) {
                Log::info('Member ID found for ' . $constituency->name . ', ' . $constituency->current_hop_member_id);
                $apiRequestUrl = 'https://members-api.parliament.uk/api/Members/' . $constituency->current_hop_member_id;
                Log::info('API request URL ' . $apiRequestUrl);
                $this->updateDecisionMakersFromApi($constituency, $apiRequestUrl); // Call the updateDecisionMakersFromApi method
            } else {
                Log::info('No member ID to use with the API found for ' . $constituency->name);
            }
        }
    }

    public function updateDecisionMakersFromApi($constituency, $apiRequestUrl): void
    {
        $client = new Client();

        $responseBody = Cache::remember('api_response_' . md5($apiRequestUrl), 60*48, function () use ($client, $apiRequestUrl) {
            $response = $client->request('GET', $apiRequestUrl);
            Log::info('API request made to ' . $apiRequestUrl);
            return json_decode($response->getBody(), true);
        });
    
        Log::info('API response received ' . json_encode($responseBody));
    
        $member = $responseBody['value'];
        if (isset($member)) {
            Log::info('Member found ' . $member['nameFullTitle']);
            $decisionMaker = DecisionMakers::firstOrNew(
                ['hop_member_id' => $member['id']]
            );
            if ($decisionMaker->exists) {
                Log::info('Decision maker already exists ' . $decisionMaker->display_name);
            } else {
                Log::info('Decision maker does not exist ' . $decisionMaker->display_name);
            }
            $decisionMaker->display_name = $member['nameFullTitle'];
            $decisionMaker->gender = $member['gender'];
            $decisionMaker->thumbnail_url = $member['thumbnailUrl'];
            $decisionMaker->current_party = $member['latestParty']['name'];
            $decisionMaker->save();
            Log::info('Decision maker saved ' . $decisionMaker->display_name);
            $constituency->decision_makers()->syncWithoutDetaching($decisionMaker->id);
            Log::info('Decision maker attached to constituency ' . $decisionMaker->display_name . ', ' . $constituency->name);
        } else {
            Log::info('Decision maker not found for ' . $constituency->name);
        }
    }
};
