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
        // Add additional fields to the decision_makers table
        Schema::table('decision_makers', function (Blueprint $table) {
            $table->string('display_name')->nullable();
            $table->string('current_party')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('is_current')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_suspended')->default(false);
            $table->boolean('is_deceased')->default(false);
            $table->boolean('is_retired')->default(false);
            $table->string('thumbnail_url')->nullable();
            $table->integer('hop_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
