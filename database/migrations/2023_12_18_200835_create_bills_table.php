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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->integer('hop_BillId');
            $table->text('shortTitle')->nullable();
            $table->text('LongTitle')->nullable();
            $table->text('summary')->nullable();
            $table->string('currentHouse')->nullable();
            $table->dateTime('lastUpdate')->nullable();
            $table->dateTime('billWithdrawn')->nullable();
            $table->boolean('isDefeated')->nullable();
            $table->integer('billTypeId')->nullable();
            $table->integer('introducedSessionId')->nullable();
            $table->json('includedSessionIds')->nullable();
            $table->boolean('isAct')->nullable();
            $table->json('currentStage')->nullable();
            $table->integer('currentStageId')->nullable();
            $table->integer('currentStageSessionId')->nullable();
            $table->string('currentStageDescription')->nullable();
            $table->string('currentStageAbbreviation')->nullable();
            $table->string('currentStageHouse')->nullable();
            $table->json('currentStageSittings')->nullable();
            $table->integer('currentStageSortOrder')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bills');
    }
};
