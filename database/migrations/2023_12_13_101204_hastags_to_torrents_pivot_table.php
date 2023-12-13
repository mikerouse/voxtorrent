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
        Schema::create('hashtags_torrent', function (Blueprint $table) {
            // Create a table to connect hashtags to torrents
            $table->id();
            $table->foreignId('hashtags_id')->constrained();
            $table->foreignId('torrent_id')->constrained();
            $table->float('weight')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hashtags_torrent', function (Blueprint $table) {
            // Drop the table to connect hashtags to torrents
            $table->dropForeign(['hashtags_id']);
            $table->dropForeign(['torrent_id']);
            $table->dropColumn(['hashtags_id', 'torrent_id']);
        });

        Schema::dropIfExists('hashtags_to_torrents_pivot');
    }
};
