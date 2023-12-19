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

class ClearBillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Log::channel('billsSeeder')->info('**********************************************');
        Log::channel('billsSeeder')->info('************ Clearing bills table ************');
        Log::channel('billsSeeder')->info('**********************************************');
        DB::table('bills')->delete();
    }
}
