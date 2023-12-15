<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // If there is a table called 'decision_maker_torrent' then rename it to 'decision_makers_torrent'
        if (Schema::hasTable('decision_maker_torrent')) {
            Schema::rename('decision_maker_torrent', 'decision_makers_torrent');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rename it back
        if (Schema::hasTable('decision_makers_torrent')) {
            Schema::rename('decision_makers_torrent', 'decision_maker_torrent');
        }
    }
};
