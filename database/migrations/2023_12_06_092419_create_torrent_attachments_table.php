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
        Schema::create('torrent_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('torrent_id'); // Column to assign a torrent's ID
            $table->foreign('torrent_id')->references('id')->on('torrents'); // Foreign key constraint to the 'torrents' table
            $table->unsignedBigInteger('owner_id'); // Column to assign an owner's ID
            $table->foreign('owner_id')->references('id')->on('users'); // Foreign key constraint to the 'users' table
            $table->string('name'); // The name of the attachment
            $table->string('description')->nullable(); // A description of the attachment
            $table->string('file_name')->nullable(); // The file name of the attachment
            $table->string('file_path')->nullable(); // The file path of the attachment
            $table->string('file_type')->nullable(); // The file type of the attachment
            $table->string('file_size')->nullable(); // The file size of the attachment
            $table->string('file_extension')->nullable(); // The file extension of the attachment
            $table->string('file_mime_type')->nullable(); // The file mime type of the attachment
            $table->string('file_url'); // The file URL of the attachment
            $table->string('file_hash')->nullable(); // The file hash of the attachment
            $table->string('file_hash_type')->nullable(); // The file hash type of the attachment
            $table->boolean('is_encrypted')->default(false); // Is the file encrypted?
            $table->string('encryption_key')->nullable(); // The encryption key of the attachment
            $table->string('encryption_key_type')->nullable(); // The encryption key type of the attachment
            $table->boolean('is_blocked')->default(false); 
            $table->boolean('is_sensitive')->default(false); 
            $table->boolean('is_trash')->default(false);
            $table->integer('flags')->default(0);
            $table->integer('weight')->default(1); // The weight of the attachment
            $table->integer('downloads')->default(0); // The number of downloads of the attachment
            $table->integer('views')->default(0); // The number of views of the attachment
            $table->integer('likes')->default(0); // The number of likes of the attachment
            $table->integer('shares')->default(0); 
            $table->integer('dislikes')->default(0); // The number of dislikes of the attachment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torrent_attachments');
    }
};
