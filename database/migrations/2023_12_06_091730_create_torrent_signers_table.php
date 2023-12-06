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
        Schema::create('torrent_signers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('signer_id'); // Column to assign an owner's ID
            $table->foreign('signer_id')->references('id')->on('users'); // Foreign key constraint to the 'users' table
            $table->unsignedBigInteger('torrent_id'); // Column to assign a torrent's ID
            $table->foreign('torrent_id')->references('id')->on('torrents'); // Foreign key constraint to the 'torrents' table
            $table->integer('weight')->default(1); // The weight of the signature
            $table->string('post_code_at_time')->nullable(); // The post code of the signer at the time of signing
            $table->boolean('is_anonymous_to_decision_maker')->default(false); // Hide the signer's identity from the decision maker
            $table->boolean('is_anonymous_to_public')->default(false); // Hide the signer's identity from the public
            $table->boolean('is_opted_in_to_contact_about_this_signature')->default(false); // Allow the decision maker to contact the signer
            $table->string('reason_for_signing')->nullable(); // A reason for signing the torrent
            $table->unsignedBigInteger('digital_certificate')->nullable(); // ID of the digital certificate used to sign the torrent
            $table->string('public_key')->nullable(); // The public key of the signer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torrent_signers');
    }
};
