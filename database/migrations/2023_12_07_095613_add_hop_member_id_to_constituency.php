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
        Schema::table('constituencies', function (Blueprint $table) {
            // Add the hop_member_id column to the constituency table
            $table->integer('hop_member_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('constituencies', function (Blueprint $table) {
            // Remove the hop_member_id column from the constituency table
            $table->dropColumn('hop_member_id');
        });
    }
};
