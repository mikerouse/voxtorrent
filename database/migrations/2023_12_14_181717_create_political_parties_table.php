<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\PoliticalPartySeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('political_parties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('wikipedia_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->boolean('is_blocked')->default(false);
            $table->boolean('is_trash')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('brand_color_hex')->nullable();
            $table->string('brand_color_rgb')->nullable();
            $table->string('brand_color_rgba')->nullable();
            $table->timestamps();
        });

        // Now link the political parties to the users table
        Schema::create('political_party_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        // Now link the political parties to the constituencies table
        Schema::create('political_party_constituency', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('constituency_id')->constrained();
            $table->timestamps();
        });

        // Now link the political parties to the decision_makers table
        Schema::create('political_party_decision_maker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('decision_makers_id')->constrained();
            $table->timestamps();
        });

        // Now link the political parties to the torrents table
        Schema::create('political_party_torrent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('torrent_id')->constrained();
            $table->timestamps();
        });

        // Now link the political parties to the hashtags table
        Schema::create('political_party_hashtag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('hashtag_id')->constrained();
            $table->timestamps();
        });

        // Now create an editors table
        Schema::create('political_party_editor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        // Now create a leaders table
        Schema::create('political_party_leader', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('decision_makers_id')->constrained();
            $table->timestamps();
        });

        // Now create a candidates table
        Schema::create('political_party_candidate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('decision_makers_id')->constrained();
            $table->timestamps();
        });

        // Now create a officials table
        Schema::create('political_party_official', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('decision_makers_id')->constrained();
            $table->timestamps();
        });

        // Now create a voters table
        Schema::create('political_party_voter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        // Now create a members table
        Schema::create('political_party_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('political_party_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        // Now seed the political parties table
        $partySeeder = new PoliticalPartySeeder();
        $partySeeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('political_parties');
        Schema::dropIfExists('political_party_user');
        Schema::dropIfExists('political_party_constituency');
        Schema::dropIfExists('political_party_decision_maker');
        Schema::dropIfExists('political_party_torrent');
        Schema::dropIfExists('political_party_hashtag');
        Schema::dropIfExists('political_party_editor');
        Schema::dropIfExists('political_party_leader');
        Schema::dropIfExists('political_party_candidate');
        Schema::dropIfExists('political_party_official');
        Schema::dropIfExists('political_party_voter');
        Schema::dropIfExists('political_party_member');
    }
};
