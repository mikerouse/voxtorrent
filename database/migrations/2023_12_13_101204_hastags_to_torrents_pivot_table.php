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
        Schema::create('hashtag_torrent', function (Blueprint $table) {
            // Create a table to connect hashtags to torrents
            $table->id();
            $table->foreignId('hashtag_id')->constrained();
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
        Schema::table('hashtag_torrent', function (Blueprint $table) {
            // Drop the table to connect hashtags to torrents
            $table->dropForeign(['hashtag_id']);
            $table->dropForeign(['torrent_id']);
            $table->dropColumn(['hashtag_id', 'torrent_id']);
        });

        Schema::dropIfExists('hashtag_to_torrent_pivot');
    }
};
