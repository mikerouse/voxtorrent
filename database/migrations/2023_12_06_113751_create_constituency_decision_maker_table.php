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
        Schema::create('constituency_decision_makers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('constituency_id');
            $table->foreign('constituency_id')->references('id')->on('constituencies');
            $table->unsignedBigInteger('decision_makers_id');
            $table->foreign('decision_makers_id')->references('id')->on('decision_makers');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constituency_decision_maker');
    }
};
