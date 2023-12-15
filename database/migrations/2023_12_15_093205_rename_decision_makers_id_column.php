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
        //
        // Rename the 'decision_maker_id' column to 'decision_makers_id'
        Schema::table('decision_makers_torrent', function (Blueprint $table) {
            $table->renameColumn('decision_maker_id', 'decision_makers_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rename the column back
        Schema::table('decision_makers_torrent', function (Blueprint $table) {
            $table->renameColumn('decision_makers_id', 'decision_maker_id');
        });
    }
};
