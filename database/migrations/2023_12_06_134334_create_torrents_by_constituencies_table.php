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
        Schema::create('torrents_by_constituencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('constituency_id');
            $table->foreign('constituency_id')->references('id')->on('constituencies');
            $table->unsignedBigInteger('torrent_id');
            $table->foreign('torrent_id')->references('id')->on('torrents');
            $table->integer('weight')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torrents_by_constituencies');
    }
};
