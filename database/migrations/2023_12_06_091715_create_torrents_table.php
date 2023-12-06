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
        // A Torrent in our context is not a way to download files.
        // It is a way to store a 'torrent of voices' to send to a decision maker.
        // Once a torrent is created, users can add their voice to it. We then figure out how best to deliver it.
        Schema::create('torrents', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Each torrent should have a friendly name for searching and listing
            $table->string('slug')->unique(); // Each torrent should have a unique slug for sharing
            $table->string("info_hash")->nullable(); // The info_hash helps us in the system to identify the torrent along with the ID
            $table->string("qr_code")->nullable(); // Data related to a QR code for the torrent so people can add their voice
            $table->text('description')->nullable(); // A description of the torrent
            $table->unsignedBigInteger('owner_id'); // Column to assign an owner's ID
            $table->foreign('owner_id')->references('id')->on('users'); // Foreign key constraint to the 'users' table
            $table->integer('weight')->default(1); // The weight of the torrent
            $table->integer('views')->default(0); // The number of views 
            $table->integer('likes')->default(0); // The number of likes 
            $table->integer('shares')->default(0); // The number of shares
            $table->integer('dislikes')->default(0); // The number of dislikes
            $table->integer('flags')->default(0); // The number of flags
            $table->boolean('is_blocked')->default(false); // Is the torrent blocked?
            $table->boolean('is_sensitive')->default(false); // Is the torrent sensitive?
            $table->boolean('is_trash')->default(false); // Is the torrent trash?
            $table->boolean('is_featured')->default(false); // Is the torrent being featured right now?
            $table->integer('avg_dwell_time_secs')->default(0); // How long are people looking at it for?

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torrents');
    }
};
