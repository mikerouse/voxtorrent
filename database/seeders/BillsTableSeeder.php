<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Legislation\BillType;
use App\Models\Legislation\Bill;
use App\Models\DecisionMakers;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Log::channel('billsSeeder')->info('Starting Parliamentary Bills API update');
        $this->seedBillTypesFromApi();
        $bills = $this->seedBillsFromApi();
        $this->enrichBillsFromApi($bills);
    }

    /**
     * Seed the bill types from the API.
     */
    public function seedBillTypesFromApi(): void
    {
        $client = new Client();
        $response = $client->get('https://bills-api.parliament.uk/api/v1/BillTypes');
        $billTypes = json_decode($response->getBody()->getContents(), true)['items'];

        foreach ($billTypes as $billType) {
            $createdBillType = BillType::create([
                'hop_id' => $billType['id'],
                'name' => $billType['name'],
                'category' => $billType['category'],
                'description' => $billType['description'],
            ]);
            Log::channel('billsSeeder')->info('Created BillType: ', ['name' => $createdBillType->name, 'id' => $createdBillType->id, 'hop_id' => $createdBillType->hop_id, 'category' => $createdBillType->category, 'description' => $createdBillType->description]);
        }
    }

    /**
     * Seed the bills from the API.
     */
    public function seedBillsFromApi()
    {
        $client = new Client();
        $response = $client->get('https://bills-api.parliament.uk/api/v1/Bills?SortOrder=DateUpdatedDescending', [
            'query' => [
                'Skip' => 0, // Start from the beginning
                'Take' => 100 // Fetch only 50 bills
            ]
        ]);
        $bills = json_decode($response->getBody()->getContents(), true)['items'];

        Log::channel('billsSeeder')->info('Seeding Bills from API');

        $returnedBills = [];
    
        foreach ($bills as $bill) {
            Log::channel('billsSeeder')->info('Seeding Bill: ', ['bill' => $bill]);

            // Check if we have already seeded this bill on a previous run
            $existingBill = Bill::where('hop_billId', $bill['billId'])->first();
            if ($existingBill) {
                Log::channel('billsSeeder')->info('Bill already exists: ', ['shortTitle' => $existingBill->shortTitle, 'hop_billId' => $existingBill->hop_billId, 'lastUpdate' => $existingBill->lastUpdate, 'billTypeId' => $existingBill->billTypeId]);
                $returnedBills[] = $existingBill;
                continue;
            } else {
                $createdBill = Bill::create([
                    'shortTitle' => $bill['shortTitle'], 
                    'longTitle' => $bill['shortTitle'], 
                    'hop_billId' => $bill['billId'],
                    'currentHouse' => $bill['currentHouse'], 
                    'lastUpdate' => $bill['lastUpdate'],
                    'billWithdrawn' => $bill['billWithdrawn'], 
                    'isDefeated' => $bill['isDefeated'], 
                    'billTypeId' => BillType::where('hop_id', $bill['billTypeId'])->first()->id,
                    'introducedSessionId' => $bill['introducedSessionId'], 
                    'includedSessionIds' => $bill['includedSessionIds'], 
                    'isAct' => $bill['isAct'], 
                    'currentStage' => $bill['currentStage'], 
                ]);
                // Add the created bill to the $returnedBills array
                $returnedBills[] = $createdBill;

                Log::channel('billsSeeder')->info('Created Bill: ', ['shortTitle' => $createdBill->shortTitle, 'hop_billId' => $createdBill->hop_billId, 'lastUpdate' => $createdBill->lastUpdate, 'billTypeId' => $createdBill->billTypeId, 'currentStage' => $createdBill->currentStage]);
            }
        }

        return $returnedBills;
    }
    
    /**
     * Enrich the bills from the API.
     */
    public function enrichBillsFromApi(Array $bills): void
    {
        // Get all of our Bills
        $enrichingClient = new Client(); // Instantiate the client outside the loop
    
        foreach ($bills as $bill) {

            if(!$bill->hop_billId) {
                Log::channel('billsSeeder')->error('No hop_billId for Bill: ', ['shortTitle' => $bill->shortTitle, 'hop_billId' => $bill->hop_billId]);
                continue;
            }

            $enrichingResponse = $enrichingClient->get('https://bills-api.parliament.uk/api/v1/Bills/' . $bill->hop_billId);
            $billData = json_decode($enrichingResponse->getBody()->getContents(), true);

            if(!$billData) {
                Log::channel('billsSeeder')->error('No data for Bill: ', ['shortTitle' => $bill->shortTitle, 'hop_billId' => $bill->hop_billId]);
                continue;
            }

            Log::channel('billsSeeder')->info('Bill Data Received: ', ['payload' => $billData]);
    
            // Prepare data for updating the Bill
            $updateData = [];
            if (isset($billData['longTitle'])) {
                $updateData['longTitle'] = $billData['longTitle'];
            } else {
                Log::channel('billsSeeder')->error('No longTitle for Bill: ', ['shortTitle' => $bill->shortTitle, 'hop_billId' => $bill->hop_billId]);
            }
            if (isset($billData['summary'])) {
                $updateData['summary'] = $billData['summary'];
            }
    
            // Update the Bill with the enriched data if available
            if (!empty($updateData)) {
                $bill->update($updateData);
                $bill->save();
            }
    
            // Check if sponsors data is available
            if (isset($billData['sponsors'])) {
                foreach ($billData['sponsors'] as $sponsorData) {
                    $sponsorMember = $sponsorData['member'];
                    Log::channel('billsSeeder')->info('Sponsor: ', ['sponsor' => $sponsorMember['name'], 'sponsorId' => $sponsorMember['memberId']]);
                    $sponsor = DecisionMakers::where('hop_member_id', $sponsorMember['memberId'])->first();
                    if ($sponsor) {
                        $bill->sponsors()->syncWithoutDetaching([$sponsor->id]);
                        Log::channel('billsSeeder')->info('Synced sponsor to Bill: ', ['shortTitle' => $bill->shortTitle, 'hop_billId' => $bill->hop_billId, 'sponsor' => $sponsor->name]);
                    } else {
                        Log::channel('billsSeeder')->error('No sponsor found in DecisionMakers table: ', ['hop_billId' => $bill->hop_billId, 'sponsor' => $sponsorMember['name'], 'sponsorId' => $sponsorMember['memberId']]);
                        $query = DecisionMakers::where('hop_member_id', $sponsorMember['memberId'])->toSql();
                        Log::channel('billsSeeder')->info('Query: ', ['query' => $query]);
                    }
                }
            } else {
                Log::channel('billsSeeder')->error('No sponsors for Bill: ', ['shortTitle' => $bill->shortTitle, 'hop_billId' => $bill->hop_billId]);
            }
    
            Log::channel('billsSeeder')->info('Enriched Bill: ', [
                'shortTitle' => $bill->shortTitle, 
                'hop_billId' => $bill->hop_billId,
                'longTitle' => $bill->longTitle ?? 'N/A', // Log 'N/A' if longTitle is not set
            ]);
        }
    }    
    
}
