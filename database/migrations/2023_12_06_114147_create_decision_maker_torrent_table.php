<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('decision_makers_torrent', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('decision_makers_id');
            $table->foreign('decision_makers_id')->references('id')->on('decision_makers');
            $table->unsignedBigInteger('torrent_id');
            $table->foreign('torrent_id')->references('id')->on('torrents');
            $table->integer('weight')->default(1);
            $table->boolean('is_engaged_with_torrent')->default(false);
            $table->boolean('has_engaged_with_torrent_at_least_once')->default(false);
            $table->boolean('is_refusing_to_engage')->default(false);
            $table->boolean('simply_disagrees')->default(false);
            $table->boolean('is_undecided')->default(false);
            $table->boolean('is_undecided_but_willing_to_be_persuaded')->default(false);
            $table->integer('times_replied_to_torrent')->default(0);
            $table->integer('times_replied_to_torrent_with_positive_sentiment')->default(0);
            $table->integer('times_replied_to_torrent_with_negative_sentiment')->default(0);
            $table->integer('times_replied_to_torrent_with_neutral_sentiment')->default(0);
            $table->string('override_email_for_this_torrent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decision_makers_torrent');
    }
};
